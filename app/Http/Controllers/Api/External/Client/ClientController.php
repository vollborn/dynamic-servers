<?php

namespace App\Http\Controllers\Api\External\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\External\ServerResource;
use App\Traits\Server\GetServer;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    use GetServer;

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

        return new ServerResource($serverModel);
    }
}