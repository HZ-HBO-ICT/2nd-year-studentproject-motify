<?php

namespace App\Http\Controllers;

use App\Models\Preferences;
use App\Services\HueService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

/**
 * @Class   HueController
 *
 * @Package App\Http\Controllers
 * @Author  Levi Deurloo <ldeurloo1@hz.nl>
 */
class HueController extends Controller
{
    /**
     * Initialize HueClient
     *
     * @var HueService
     */
    protected $service;

    /**
     * Initialize Preferences
     *
     * @var Preferences
     */
    protected $preferences;

    /**
     * HueController constructor.
     *
     * @param HueService $hueService
     */
    public function __construct()
    {
        $this->preferences = Preferences::find(1);
        $this->service = new HueService();
    }

    /**
     * @return void
     */
    public function auth()
    {
        $this->service->startOAuth();
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws GuzzleException
     */
    public function receive(Request $request)
    {
        if ($code = $request->input('code')) {
            $this->service->getAccessTokenForTheFirstTime($code);
            $username = $this->service->createUser();
            $this->preferences->update(['hue_username' => $username]);

            if ($this->preferences->update(['hue_username' => $username]))
                return redirect()->to('/callback/success');
            else throw e($username);
        }

        return redirect()->to('/callback/error');
    }
}

