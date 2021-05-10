<?php

namespace App\Events;

use App\Models\Server;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class ServerSeen
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Server
     */
    protected Server $server;
    /**
     * @var \Illuminate\Support\Carbon|null
     */
    protected ?Carbon $lastSeenAt;
    /**
     * @var \Illuminate\Support\Carbon
     */
    protected Carbon $now;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Server $server, Carbon $now)
    {
        $this->server = $server;
        $this->lastSeenAt = Carbon::parse($server->last_seen_at);
        $this->now = $now;
    }

    /**
     * @return \App\Models\Server
     */
    public function getServer(): Server
    {
        return $this->server;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getLastSeenAt(): ?Carbon
    {
        return $this->lastSeenAt;
    }

    /**
     * @return \Illuminate\Support\Carbon
     */
    public function getNow(): Carbon
    {
        return $this->now;
    }
}
