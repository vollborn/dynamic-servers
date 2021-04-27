<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\BackgroundImage\BackgroundImageController;
use App\Http\Controllers\Api\Dashboard\DashboardController;
use App\Http\Controllers\Api\NotificationChannelType\NotificationChannelTypeController;
use App\Http\Controllers\Api\ServerNotificationChannel\ServerNotificationChannelController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Server\ServerController;
use App\Http\Controllers\Api\ServerStatistic\ServerStatisticController;
use App\Http\Controllers\Api\External\Client\ClientController;
use App\Http\Controllers\Api\External\Host\HostController;
use Illuminate\Support\Facades\Route;

/*
 * Auth
 */
Route::group(['prefix' => 'auth'], static function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('register/available', [AuthController::class, 'registerAvailable']);
});

/*
 * Client / Host
 */
Route::group(['prefix' => 'status/{server}/{token}'], static function () {
    Route::post('', [HostController::class, 'update']);
    Route::get('', [ClientController::class, 'show']);
});

Route::group(['middleware' => 'auth:api'], static function () {

    /*
     * Auth
     */
    Route::group(['prefix' => 'auth'], static function () {
        Route::get('', [AuthController::class, 'getAuth']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

    /*
     * Dashboard
     */
    Route::group(['prefix' => 'dashboard'], static function () {
       Route::get('total-requests-chart', [DashboardController::class, 'totalRequestsChart']);
    });

    /*
     * Profile
     */
    Route::group(['prefix' => 'profile'], static function () {
        Route::get('', [ProfileController::class, 'show']);
        Route::put('', [ProfileController::class, 'update']);
    });

    /*
     * Servers
     */
    Route::group(['prefix' => 'servers'], static function () {
        Route::get('', [ServerController::class, 'index']);
        Route::get('{server}', [ServerController::class, 'show']);
        Route::post('', [ServerController::class, 'store']);
        Route::put('{server}', [ServerController::class, 'update']);
        Route::delete('{server}', [ServerController::class, 'delete']);

        Route::post('{server}/enable', [ServerController::class, 'enable']);
        Route::post('{server}/disable', [ServerController::class, 'disable']);

        /*
         * Server NotificationChannels
         */
        Route::group(['prefix' => '{server}/notification-channels'], static function () {
            Route::get('', [ServerNotificationChannelController::class, 'index']);
            Route::post('', [ServerNotificationChannelController::class, 'store']);
            Route::delete('{notificationChannel}', [ServerNotificationChannelController::class, 'delete']);
        });

        /*
         * Server Statistics
         */
        Route::group(['prefix' => '{server}/statistics'], static function () {
            Route::get('', [ServerStatisticController::class, 'index']);
        });
    });

    /*
     * NotificationChannelTypes
     */
    Route::group(['prefix' => 'notification-channel-types'], static function () {
        Route::get('', [NotificationChannelTypeController::class, 'index']);
    });

    /*
     * BackgroundImages
     */
    Route::group(['prefix' => 'background-images'], static function () {
        Route::get('', [BackgroundImageController::class, 'index']);
    });
});