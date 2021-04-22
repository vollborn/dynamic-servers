<?php

namespace App\Http\Controllers\Api\ServerStatistic;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatisticResource;
use App\Models\Server;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ServerStatisticController extends Controller
{
    /**
     * @param Server $server
     * @return AnonymousResourceCollection
     */
    public function index(Server $server): AnonymousResourceCollection
    {
        $statistics = $server->statistics()->get();
        return StatisticResource::collection($statistics);
    }
}