<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
        // todo
        // ( release log | news | random facts | maintenance ? )

        // welcome
        // server limit         |               status requests sum
        // Support              |               Source Code
    }

    /**
     * @return array
     */
    public function totalRequestsChart(): array
    {
        $serverIds = Auth::user()->servers->map(static function ($item) {
            return $item->id;
        });

        $statistics = Statistic::whereIn('server_id', $serverIds)
            ->whereDate('counting_at', '>', today()->subDays(30))
            ->orderBy('counting_at')
            ->get();

        $return = [];
        foreach ($statistics as $statistic) {
            $date = Carbon::parse($statistic->counting_at)->format('d.m.Y');
            if (!array_key_exists($date, $return)) {
                $return[$date] = 0;
            }
            $return[$date] += $statistic->requests_count;
        }

        return $return;
    }
}