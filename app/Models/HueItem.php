<?php

namespace App\Models;

use App\Interfaces\IHueItem;
use App\Resources\DynamicHueResource;
use App\Services\HueService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

/**
 * @Class   HueItem
 *
 * @Package App\Models
 * @Author  Levi Deurloo <ldeurloo1@hz.nl>
 */
class HueItem implements IHueItem
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $hueUser;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var \App\Models\Preferences
     */
    protected $preferences;

    /**
     * @inheritDoc
     */
    public function __construct(string $category)
    {
        $this->client = new Client();
        $this->category = $category;

        $this->preferences =  \App\Models\Preferences::find(1);
        $this->hueUser = $this->preferences->hue_username;
    }

    /**
     * @inheritDoc
     */
    public function all(array $params = [], string $filter = null)
    {
        $all = $this->send(null, 'get', $params);

        if ($this->category === 'config')
            $resources = $all;
        else {
            if ($this->category === 'groups')
                $filter = 'Room';

            $resources = array();

            foreach($all as $key => $value) {
                $value->id = (int)$key;

                if ($filter) {
                    if ($value->type === $filter)
                        array_push($resources, new DynamicHueResource($this->category, $value));
                } else array_push($resources, new DynamicHueResource($this->category, $value));
            }
        }
        return $resources;
    }

    /**
     * Sends a request and returns response from Hue app
     *
     * @param int|null|string $id
     * @param string          $method
     * @param array           $params
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function send($id = null, string $method = 'get', array $params = [])
    {
        $options = [
            'headers' => ['Authorization' => 'Bearer '. (new HueService)->refreshAndGetAccessToken(),
                'Content-Type' => 'application/json']
        ];

        if ($params)
            $options['json'] = $params;

        if ($id)
            $idOrNot = '/'.$id;
        else
            $idOrNot = '';

        $r = $this->client->{$method}('https://api.meethue.com/bridge/'.$this->hueUser.'/'.$this->category.$idOrNot, $options);

        return json_decode($r->getBody()->getContents());
    }

    /**
     * @inheritDoc
     */
    public function byID($id, array $params = [])
    {
        $item = $this->send($id, 'get', $params);

        return new DynamicHueResource($this->category, $item);
    }

    /**
     * @inheritDoc
     */
    public function save(array $params = [])
    {
        $item = $this->send(null, 'post', $params);

        return new DynamicHueResource($this->category, $item);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, int $id, string $custom = null)
    {
        $params = $request->toArray();

        $item = $this->send($id.'/'.$custom, 'put', $params);

        return new DynamicHueResource($this->category, $item);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id)
    {
        return $this->send($id, 'delete');
    }
}
