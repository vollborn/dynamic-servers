<?php

namespace App\Http\Controllers\Api\External\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\External\ServerResource;
use App\Traits\Server\GetServer;
use App\Traits\Statistic\CountServerRequest;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    use GetServer,
        CountServerRequest;

    /**
     * @param int $server
     * @param string $token
     * @return ServerResource
     */
    public function show(int $server, string $token): ServerResource
    {
        $serverModel = $this->getServer($server, ['backgroundImage']);

        if (!$serverModel) {
            abort(404);
        }

        if ($serverModel->request_token !== $token) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $this->countServerRequest($serverModel);
        return new ServerResource($serverModel);
    }
}