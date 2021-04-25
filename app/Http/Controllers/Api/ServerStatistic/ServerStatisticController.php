<?php

namespace App\Http\Controllers\Api\ServerStatistic;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Carbon\Carbon;

class ServerStatisticController extends Controller
{
    /**
     * @param Server $server
     * @return array
     */
    public function index(Server $server): array
    {
        $statistics = $server->statistics()
            ->whereDate('counting_at', '>', today()->subDays(30))
            ->orderBy('counting_at')
            ->get();

        return [
            'requests' => $this->getRequestChartData($statistics),
            'downtime' => $this->getDowntimeChartData($statistics)
        ];
    }

    /**
     * @param $statistics
     * @return array
     */
    protected function getRequestChartData($statistics): array
    {
        $return = [];
        foreach ($statistics as $statistic) {
            $return[Carbon::parse($statistic->counting_at)->format('d.m.Y')] = $statistic->requests_count;
        }
        return $return;
    }

    /**
     * @param $statistics
     * @return array
     */
    protected function getDowntimeChartData($statistics): array
    {
        $return = [];
        foreach ($statistics as $statistic) {
            $return[Carbon::parse($statistic->counting_at)->format('d.m.Y')] = floor($statistic->downtime / 60);
        }
        return $return;
    }
}