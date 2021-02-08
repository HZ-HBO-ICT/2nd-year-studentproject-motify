<?php

namespace App\Services;

use App\Resources\DynamicHueResource;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @Class   HueService
 *
 * @Package App\Services
 * @Author  Levi Deurloo <ldeurloo1@hz.nl>
 */
class HueService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var \App\Models\Preferences
     */
    protected $preferences;

    /**
     * @var string
     */
    protected $hueUser;

    /**
     * HueService constructor.
     *
     * @param int $id
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->preferences = \App\Models\Preferences::find(1);
        $this->hueUser = $this->preferences->hue_username;
    }

    /**
     * Create the application's first access token with this function.
     * You 'll need to login at the Philips Hue website
     * (Not on localhost, unless you use Ngrok)
     *
     * @param string $code
     *
     * @return JsonResponse|string
     * @throws GuzzleException
     */
    public function getAccessTokenForTheFirstTime(string $code)
    {
        if (isset($this->preferences->hue_access_token))
            return $this->preferences->hue_access_token;

        $r = $this->client->post('https://api.meethue.com/oauth2/token', [
            'query' => [
                'code' => $code,
                'grant_type' => 'authorization_code'
            ],
            'headers' => [
                'Authorization' => 'Basic '.base64_encode($this->preferences->hue_client_id.':'.$this->preferences->hue_client_secret),
                'Content-Type' => 'application/json'
            ]
        ]);

        $data = $r->getBody()->getContents();
        $this->setTokens($data);

        return json_decode($data);
    }

    /**
     * Store the tokens in the database after initialize or refresh.
     * TODO: Code cleanup
     *
     * @param  $data
     *
     * @return void
     */
    public function setTokens($data)
    {
        $data = json_decode($data);

        $data->access_token_expires_at = Carbon::now()
            ->addSeconds($data->access_token_expires_in)
            ->format('Y-m-d H:i:s');

        $data->refresh_token_expires_at = Carbon::now()
            ->addSeconds($data->refresh_token_expires_in)
            ->format('Y-m-d H:i:s');

        $this->preferences->hue_access_token = $data->access_token;
        $this->preferences->hue_access_token_expires_in = $data->access_token_expires_in;
        $this->preferences->hue_access_token_expires_at = $data->access_token_expires_at;

        $this->preferences->hue_refresh_token = $data->refresh_token;
        $this->preferences->hue_refresh_token_expires_in = $data->refresh_token_expires_in;
        $this->preferences->hue_refresh_token_expires_at = $data->refresh_token_expires_at;
        $this->preferences->update();
    }

    /**
     * @return void
     */
    public function startOAuth()
    {
        $parameters = http_build_query([
            'clientid' => $this->preferences->hue_client_id,
            'appid' => 'motify',
            'deviceid' => $this->preferences->hue_device_id,
            'response_type' => 'code'
        ]);

        header('Location: https://api.meethue.com/oauth2/auth?'.$parameters);
        exit;
    }

    /**
     * Creates a new user in your Hue Bridge. When you disable force link button you will have to manually
     * press the link button on your bridge.
     * It will return the username right away.
     *
     * @param string|null $name
     * @param bool        $forceLinkButton
     *
     * @return string
     * @throws GuzzleException
     */
    public function createUser(string $name = null, bool $forceLinkButton = true)
    {
        if (!$name)
            $name = Str::random(6);

        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.$this->refreshAndGetAccessToken(),
                'Content-Type' => 'application/json'
            ]
        ];

        if ($forceLinkButton) {
            $options['json'] = ['linkbutton' => true];

            $this->client->put('https://api.meethue.com/bridge/0/config', $options);
        }
        $options['json'] = ['devicetype' => 'MotifyApp'.'#'.$name];
        $arr = json_decode($this->client->post('https://api.meethue.com/bridge', $options)->getBody()->getContents());
        return object_get(Arr::first($arr), 'success.username');
    }

    /**
     * @return string
     * @throws GuzzleException
     */
    public function refreshAndGetAccessToken()
    {
        if (Carbon::createFromTimestamp(strtotime($this->preferences->hue_access_token_expires_at)) > Carbon::now())
            return $this->preferences->hue_access_token;

        $r = $this->client->post('https://api.meethue.com/oauth2/refresh?grant_type=refresh_token', [

            'headers' => [
                'Authorization' => 'Basic '.base64_encode($this->preferences->hue_client_id.' : '.$this->preferences->hue_client_secret),
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'refresh_token' => $this->preferences->hue_refresh_token,
            ],
        ]);

        $data = $r->getBody()->getContents();
        $this->setTokens($data);
        $data = json_decode($data);

        return $data['access_token'];
    }

    /**
     * Returns a new user in your bridge.
     *
     * @param string $id
     *
     * @return \App\Resources\DynamicHueResource
     * @throws GuzzleException
     */
    public function get(string $id)
    {
        return new DynamicHueResource('users', $this->client->get('https://api.meethue.com/bridge/'.$id.'/config'));
    }
}
