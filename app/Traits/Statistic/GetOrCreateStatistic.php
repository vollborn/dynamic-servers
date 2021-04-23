<?php

namespace App\Traits\Statistic;

use App\Models\Server;

trait GetOrCreateStatistic
{
    /**
     * @param \App\Models\Server $server
     * @param $date
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    protected function getOrCreateStatistic(Server $server, $date = null)
    {
        if (!$date) {
            $date = today();
        }

        $statistic = $server->statistics()
            ->whereDate('counting_at', $date)
            ->first();

        if (!$statistic) {
            $statistic = $server->statistics()->create([
               'counting_at' => $date
            ]);
        }

        return $statistic;
    }
}