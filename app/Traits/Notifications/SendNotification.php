<?php

namespace App\Traits\Notifications;

use App\Models\Server;
use App\Notifications\StatusNotification;

trait SendNotification
{
    /**
     * @param Server $server
     */
    protected function sendNotifications(Server $server)
    {
        if (env('APP_ENV') === 'local') {
            return;
        }

        $notificationChannels = $server->notificationChannels()->get();
        foreach ($notificationChannels as $notificationChannel) {
            $notificationChannel->notify(new StatusNotification($server));
        }
    }
}