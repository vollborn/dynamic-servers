<?php

namespace App\Listeners\ServerIpUpdated;

use App\Events\ServerIpUpdated;
use App\Traits\Functions\GetIpAddress;
use Illuminate\Contracts\Queue\ShouldQueue;

class GetAddressInfo implements ShouldQueue
{
    use GetIpAddress;

    /**
     * Handle the event.
     *
     * @param  ServerIpUpdated  $event
     * @return void
     */
    public function handle(ServerIpUpdated $event)
    {
        $server = $event->getServer();
        $server->ip_address_details = $this->getIpAddressDetails($server->ip_address);
        $server->save();
    }
}
