<?php

/**
 * --------------------------------------------------------------------------
 * @namespace Web
 * --------------------------------------------------------------------------
 */
use App\Http\Controllers\HueController;
use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Route;


/**
 * --------------------------------------------------------------------------
 *  Authenticate the Philips Hue service
 * --------------------------------------------------------------------------
 *  @URL:            /hue/auth
 *  @@Controller:    HueController(Request $request)
 *  @Method:         GET
 *  @Description:    Redirects you to the Hue authentication page
 *
 * */
Route::get('/hue/auth', [HueController::class, 'auth']);

/**
 * --------------------------------------------------------------------------
 *  Callback for the Philips Hue service
 * --------------------------------------------------------------------------
 *  @URL:            /hue/auth/receive
 *  @Controller:     HueController(Request $request)
 *  @Method:         POST
 *  @Description:    Redirects you from the Hue authentication page back to
 *  the app
 * */
Route::get('/hue/auth/receive', [HueController::class, 'receive']);

/**
 * --------------------------------------------------------------------------
 *  Callback for the Philips Hue service
 * --------------------------------------------------------------------------
 *  @URL:            /{any}
 *  @Controller:     SpaController
 *  @Method:         GET
 *  @Description:    Handles the Vue combination
 * */
Route::get('/{any}', [SpaController::class, 'index'])->where('any','.*' );
