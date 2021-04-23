<?php

namespace App\Traits\Statistic;

use App\Models\Server;

trait CountServerRequest
{
    use GetOrCreateStatistic;

    protected function countServerRequest(Server $server)
    {
        $statistic = $this->getOrCreateStatistic($server);
        $statistic->requests_count++;
        $statistic->save();
    }
}