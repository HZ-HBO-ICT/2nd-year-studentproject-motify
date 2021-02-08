<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BuddyController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\HueItemController;
use App\Http\Controllers\Api\ProjectRoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {

    //Open Routes
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('jwt.refresh')->group(function () {
        Route::get('refresh', [AuthController::class, 'refresh']);
    });

    //Secure Routes
    Route::middleware('auth:api')->group(function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

});

/**
 * @Route Project Room Routes
 */
Route::get('/projectRooms', [ProjectRoomController::class, 'index']);
Route::post('/projectRooms/connect', [ProjectRoomController::class, 'connect']);

Route::get('/projectRooms/{projectRoom}', [ProjectRoomController::class, 'show']);

/**
 * @Route Feedback routes
 */
Route::get('/feedback', [FeedbackController::class, 'index']);
Route::post('/feedback/store', [FeedbackController::class, 'store']);

/**
 * -------------------------------------------------------------------------------
 * @Group      Colors
 * -------------------------------------------------------------------------------
 * @URL        :    /api/colors
 * @Controller :    ColorController(Request $request)
 * @Method     :    { GET, POST, PUT, DELETE }
 * @Description:    The colors which can be used to set the room color
 **/
Route::apiResource('colors', '\App\Http\Controllers\Api\ColorController');

/**
 * -------------------------------------------------------------------------------
 * @Group      Buddies
 * -------------------------------------------------------------------------------
 * @URL        :    /api/buddies
 * @Controller :    BuddyController(Request $request)
 * @Method     :    { GET, POST, PUT, DELETE }
 * @Description:    The buddies crud functions
 **/
Route::apiResource('buddies', '\App\Http\Controllers\Api\BuddyController');
Route::middleware('api')->post('/buddies/{id}/notify',  function (Request $request) {
    return (new BuddyController)->notify($request->id);
});

Route::name('buddyInvite.accept')->get('/buddyInvites/{buddyInvite}/accept', [BuddyController::class, 'acceptInvite']);
Route::get('/buddyInvites/{buddyInvite}/status', [BuddyController::class, 'inviteStatus']);


/**
 * -------------------------------------------------------------------------------
 * @Group      Hue prefix
 * -------------------------------------------------------------------------------
 * @URL        :     /api/hue/*
 * @Controller :     HueController(Request $request)
 * @Method     :     POST
 * @Description:    Use the hue prefix with this dynamic routes
 **/
Route::group(['prefix' => 'hue'], function () {
    Route::get('{category}', function (Request $request, string $category) {
        return (new HueItemController($category))->index($request);
    });
    Route::get('{category}/{id}', function (Request $request, string $category, int $id) {
        return (new HueItemController($category))->show((int)$id);
    });
    Route::put('{category}/{id}', function (Request $request, string $category, int $id) {
        return (new HueItemController($category))->update($request, $id);
    });
    Route::put('{category}/{id}/{custom}', function (Request $request, string $category, int $id, string $custom) {
        return (new HueItemController($category))->update($request, $id, $custom);
    });
    Route::post('{category}', function (Request $request, string $category) {
        return (new HueItemController($category))->store($request);
    });
    Route::delete('{category}/{id}', function (Request $request, string $category, int $id) {
        return (new HueItemController($category))->destroy($id);
    });
});

//  Authentication Routes

