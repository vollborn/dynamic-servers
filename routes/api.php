<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\NotificationChannel\NotificationChannelController;
use App\Http\Controllers\Api\Server\ServerController;
use App\Http\Controllers\Api\Statistic\StatisticController;
use Illuminate\Support\Facades\Route;

/*
 * Auth / Login
 */
Route::post('auth/login', [AuthController::class, 'login']);

/*
 * Api Routes
 */
Route::group(['middleware' => 'auth:api'], static function () {

    /*
     * Auth
     */
    Route::group(['prefix' => 'auth'], static function () {
        Route::get('', [AuthController::class, 'getAuth']);
        Route::post('logout', [AuthController::class, 'logout']);
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