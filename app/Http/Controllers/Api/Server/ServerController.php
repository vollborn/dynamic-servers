<?php

namespace App\Http\Controllers\Api\Server;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServerResource;
use App\Models\Server;
use App\Rules\CustomLabels;
use App\Rules\NotificationChannels;
use App\Rules\RequestInterval;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ServerController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $servers = Server::where('user_id', Auth::id())->get();
        return ServerResource::collection($servers);
    }

    /**
     * @param Server $server
     * @return ServerResource
     */
    public function show(Server $server): ServerResource
    {
        $server->loadMissing([
            'notificationChannels',
            'backgroundImage'
        ]);

        return new ServerResource($server);
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $data = request()->validate([
            'name'                 => 'required|string|max:255',
            'requestInterval'      => ['required', new RequestInterval],
            'notificationChannels' => ['required', new NotificationChannels],
            'customLabels'         => ['required', new CustomLabels],
            'backgroundImageId'    => 'nullable|int|exists:background_images,id',
        ]);

        $user = Auth::user();
        if ($user->servers()->count() >= $user->server_limit) {
            return $this->json(__('controllers.server.limit_reached'), Response::HTTP_CONFLICT);
        }

        try {
            $server = Server::create([
                'user_id'             => Auth::id(),
                'name'                => $data['name'],
                'custom_labels'       => $data['customLabels'],
                'request_interval'    => $data['requestInterval'],
                'server_token'        => Str::random(config('servers.server_token_length')),
                'request_token'       => Str::random(config('servers.request_token_length')),
                'background_image_id' => $data['backgroundImageId'] ?? config('servers.default.background_image_id')
            ]);

            if ($data['notificationChannels']) {
                $decoded = json_decode($data['notificationChannels'], true, 512, JSON_THROW_ON_ERROR);
                foreach ($decoded as $channel) {
                    $server->notificationChannels()->create([
                        'notification_channel_type_id' => $channel['notificationChannelTypeId'],
                        'content'                      => $channel['content']
                    ]);
                }
            }
        } catch (Exception $exception) {
            return $this->exception($exception);
        }

        return $this->json(__('controllers.server.stored'));
    }

    /**
     * @param Server $server
     * @return JsonResponse
     */
    public function update(Server $server): JsonResponse
    {
        $data = request()->validate([
            'requestInterval'   => ['required', new RequestInterval],
            'customLabels'      => ['required', new CustomLabels],
            'backgroundImageId' => 'required|int|exists:background_images,id',
        ]);

        try {
            $server->update([
                'request_interval'    => $data['requestInterval'],
                'custom_labels'       => $data['customLabels'],
                'background_image_id' => $data['backgroundImageId'] ?? config('servers.background_image_id'),
            ]);
        } catch (Exception $exception) {
            return $this->exception($exception);
        }

        return $this->json(__('controllers.server.updated'));
    }

    /**
     * @param Server $server
     * @return JsonResponse
     */
    public function delete(Server $server): JsonResponse
    {
        try {
            $server->delete();
        } catch (Exception $exception) {
            return $this->exception($exception);
        }

        return $this->json(__('controllers.server.deleted'));
    }

    /**
     * @param Server $server
     * @return JsonResponse
     */
    public function disable(Server $server): JsonResponse
    {
        $server->disabled_at = now();
        $server->save();
        return $this->json('controllers.server.disabled');
    }

    /**
     * @param Server $server
     * @return JsonResponse
     */
    public function enable(Server $server): JsonResponse
    {
        $server->disabled_at = null;
        $server->save();
        return $this->json('controllers.server.enabled');
    }

}