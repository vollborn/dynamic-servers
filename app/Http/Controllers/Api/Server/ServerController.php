<?php

namespace App\Http\Controllers\Api\Server;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServerResource;
use App\Models\Server;
use App\Rules\RequestInterval;
use App\Traits\Server\VerifyCustomLabels;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ServerController extends Controller
{
    use VerifyCustomLabels;

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
            'name'              => 'required|string|max:255',
            'requestInterval'   => ['required', new RequestInterval],
            'customLabels'      => 'nullable|json',
            'backgroundImageId' => 'nullable|int|exists:background_images,id',
        ]);

        try {
            Server::create([
                'user_id'             => Auth::id(),
                'name'                => $data['name'],
                'server_token'        => Str::random(config('servers.server_token_length')),
                'request_token'       => Str::random(config('servers.request_token_length')),
                'custom_labels'       => $this->verifyCustomLabels($data),
                'background_image_id' => $data['backgroundImageId'] ?? config('servers.default.background_image_id'),
                'request_interval'    => $data['requestInterval']
            ]);
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
            'backgroundImageId' => 'required|int|exists:background_images,id',
            'customLabels'      => 'nullable|json',
        ]);

        try {
            $server->update([
                'request_interval'    => $data['requestInterval'],
                'custom_labels'       => $this->verifyCustomLabels($data),
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

}