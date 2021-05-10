<?php

namespace App\Http\Controllers\Api\External\Host;

use App\Events\ServerIpUpdated;
use App\Events\ServerSeen;
use App\Http\Controllers\Controller;
use App\Traits\Functions\GetIpAddress;
use App\Traits\Server\GetServer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class HostController extends Controller
{
    use GetIpAddress,
        GetServer;

    /**
     * @param int $server
     * @param string $token
     * @return JsonResponse
     */
    public function update(int $server, string $token): JsonResponse
    {
        $serverModel = $this->getServer($server);
        if (!$serverModel) {
            abort(Response::HTTP_NOT_FOUND);
        }

        if ($serverModel->server_token !== $token) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        event(new ServerSeen($serverModel, now()));

        $ipAddress = $this->getIpAddress();
        if ($serverModel->ip_address !== $ipAddress) {
            $serverModel->ip_address = $ipAddress;
            $serverModel->ip_address_details = null;
            $serverModel->last_updated_at = now();

            event(new ServerIpUpdated($serverModel));
            $response = __('controllers.external.host.updated');
        } else {
            $response = __('controllers.external.host.unchanged');
        }
        $serverModel->last_seen_at = now();
        $serverModel->save();

        return $this->json($response);
    }
}