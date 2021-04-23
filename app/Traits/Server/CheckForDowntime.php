<?php

namespace App\Traits\Server;

use App\Models\Server;
use App\Traits\Statistic\GetOrCreateStatistic;
use Carbon\Carbon;

trait CheckForDowntime
{
    use GetOrCreateStatistic;

    protected function checkForDowntime(Server $server)
    {
        $lastSeen = Carbon::parse($server->last_seen_at);

        $timeDiff = now()->diffInSeconds($lastSeen);
        if ($timeDiff <= $server->request_interval / 1000) {
            return;
        }

        if (today()->toDateString() === $lastSeen->toDateString()) {

            $statistic = $this->getOrCreateStatistic($server, now());
            $statistic->downtime += $timeDiff;
            $statistic->save();

        } else {

            $afterFirstDay = $lastSeen->copy()->addDay()->startOfDay();
            $beforeLastDay = today()->subDay()->endOfDay();

            $firstDay = $this->getOrCreateStatistic($server, $lastSeen);
            $firstDay->downtime += $lastSeen->diffInSeconds($afterFirstDay);
            $firstDay->save();

            if (today()->toDateString() !== $afterFirstDay->toDateString()) {
                $iterateDate = $afterFirstDay->copy();
                while (today()->isAfter($iterateDate)) {
                    $statistic = $this->getOrCreateStatistic($server, $iterateDate);
                    $statistic->downtime = 86400;
                    $statistic->save();
                    $iterateDate->addDay();
                }
            }

            $lastDay = $this->getOrCreateStatistic($server, today());
            $lastDay->downtime += now()->diffInSeconds($beforeLastDay);
            $lastDay->save();
        }
    }
}