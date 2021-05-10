<?php

namespace App\Providers;

use App\Events\ServerIpUpdated;
use App\Events\ServerSeen;
use App\Listeners\ServerIpUpdated\GetAddressInfo;
use App\Listeners\ServerIpUpdated\SendNotifications;
use App\Listeners\ServerSeen\CheckForDowntime;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [
        ServerSeen::class      => [
            CheckForDowntime::class
        ],
        ServerIpUpdated::class => [
            GetAddressInfo::class,
            SendNotifications::class
        ]
    ];
}
