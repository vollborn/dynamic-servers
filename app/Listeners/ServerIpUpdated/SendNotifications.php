<?php

namespace App\Listeners\ServerIpUpdated;

use App\Events\ServerIpUpdated;
use App\Notifications\StatusNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotifications implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  ServerIpUpdated  $event
     * @return void
     */
    public function handle(ServerIpUpdated $event)
    {
        $server = $event->getServer();

        $notificationChannels = $server->notificationChannels()->get();
        foreach ($notificationChannels as $notificationChannel) {
            $notificationChannel->notify(new StatusNotification($server));
        }
    }
}
