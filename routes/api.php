<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\NotificationChannel\NotificationChannelController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Server\ServerController;
use App\Http\Controllers\Api\Statistic\StatisticController;
use App\Http\Controllers\Api\External\Client\ClientController;
use App\Http\Controllers\Api\External\Host\HostController;
use Illuminate\Support\Facades\Route;

/*
 * Auth
 */
Route::group(['prefix' => 'auth'], static function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
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

        /*
         * NotificationChannels
         */
        Route::group(['prefix' => '{server}/notification-channels'], static function () {
            Route::get('', [NotificationChannelController::class, 'index']);
            Route::post('', [NotificationChannelController::class, 'store']);
            Route::delete('{notificationChannel}', [NotificationChannelController::class, 'delete']);
        });

        /*
         * Statistics
         */
        Route::group(['prefix' => '{server}/statistics'], static function () {
            Route::get('', [StatisticController::class, 'index']);
        });
    });
});