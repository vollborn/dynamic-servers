<?php

namespace App\Listeners\ServerSeen;

use App\Events\ServerSeen;
use App\Traits\Statistic\GetOrCreateStatistic;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckForDowntime implements ShouldQueue
{
    use GetOrCreateStatistic;

    /**
     * Handle the event.
     *
     * @param  ServerSeen  $event
     * @return void
     */
    public function handle(ServerSeen $event)
    {
        $server = $event->getServer();
        $lastSeen = $event->getLastSeenAt();
        $now = $event->getNow();

        $timeDiff = $now->diffInSeconds($lastSeen);
        if ($timeDiff <= $server->request_interval / 1000) {
            return;
        }

        if (today()->toDateString() === $lastSeen->toDateString()) {

            $statistic = $this->getOrCreateStatistic($server, $now);
            $statistic->downtime += $timeDiff;
            $statistic->save();

        } else {

            $afterFirstDay = $lastSeen->copy()->addDay()->startOfDay();
            $beforeLastDay = $now->copy()->subDay()->endOfDay();

            $firstDay = $this->getOrCreateStatistic($server, $lastSeen);
            $firstDay->downtime += $lastSeen->diffInSeconds($afterFirstDay);
            $firstDay->save();

            if ($now->copy()->toDateString() !== $afterFirstDay->toDateString()) {
                $iterateDate = $afterFirstDay->copy();
                while ($now->isAfter($iterateDate)) {
                    $statistic = $this->getOrCreateStatistic($server, $iterateDate);
                    $statistic->downtime = 86400;
                    $statistic->save();
                    $iterateDate->addDay();
                }
            }

            $lastDay = $this->getOrCreateStatistic($server, $now);
            $lastDay->downtime += $now->diffInSeconds($beforeLastDay);
            $lastDay->save();
        }
    }
}
