<?php

namespace App\Traits\Server;

use App\Models\Server;

trait GetServer
{
    /**
     * @param int $serverId
     * @param array|null $relations
     * @return mixed
     */
    protected function getServer(int $serverId, array $relations = null)
    {
        if ($relations === null) {
            $relations = [];
        }

        return Server::withoutGlobalScope('own')
            ->where('id', $serverId)
            ->with($relations)
            ->first();
    }
}