<?php

namespace App\Http\Controllers\Api\External\Host;

use App\Http\Controllers\Controller;
use App\Traits\Functions\GetIpAddress;
use App\Traits\Server\GetServer;
use App\Traits\Notifications\SendNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class HostController extends Controller
{
    use GetIpAddress,
        GetServer,
        SendNotification;

    /**
     * @param int $server
     * @param string $token
     * @return JsonResponse
     */
    public function update(int $server, string $token): JsonResponse
    {
        $serverModel = $this->getServer($server);
        if (!$serverModel) {
            abort(404);
        }

        if ($serverModel->server_token !== $token) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $ipAddress = $this->getIpAddress();
        if ($serverModel->ip_address !== $ipAddress) {
            $serverModel->ip_address = $ipAddress;
            $serverModel->ip_address_details = $this->getIpAddressDetails($ipAddress);
            $serverModel->last_updated_at = now();

            // $this->sendNotifications($serverModel);
            $response = __('controllers.external.host.updated');
        } else {
            $response = __('controllers.external.host.unchanged');
        }
        $serverModel->last_seen_at = now();
        $serverModel->save();

        $this->sendNotifications($serverModel);

        return $this->json($response);
    }
}