<?php

namespace App\Http\Controllers\Api\ServerNotificationChannel;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationChannelResource;
use App\Models\Server;
use App\Rules\NotificationChannelType;
use App\Traits\Notifications\ValidateNotificationChannelContent;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ServerNotificationChannelController extends Controller
{
    use ValidateNotificationChannelContent;

    /**
     * @param Server $server
     * @return AnonymousResourceCollection
     */
    public function index(Server $server): AnonymousResourceCollection
    {
        $notificationChannels = $server->notificationChannels()->get();
        return NotificationChannelResource::collection($notificationChannels);
    }

    /**
     * @param Server $server
     * @return JsonResponse
     */
    public function store(Server $server): JsonResponse
    {
        $data = request()->validate([
            'notificationChannelTypeId' => ['required', new NotificationChannelType],
            'content'                   => 'required|string'
        ]);

        if (!$this->validateNotificationChannelContent($data['notificationChannelTypeId'], $data['content'])) {
            return $this->json(__('notifications.store.invalid_channel_content'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($server->notificationChannels()->count() >= $server->notification_channel_limit) {
            return $this->json(__('controllers.notification_channel.limit_reached'), Response::HTTP_CONFLICT);
        }

        try {
            $server->notificationChannels()->create([
                'notification_channel_type_id' => $data['notificationChannelTypeId'],
                'content'                      => $data['content']
            ]);
        } catch (Exception $exception) {
            return $this->exception($exception);
        }

        return $this->json(__('controllers.notification_channel.stored'));
    }

    /**
     * @param Server $server
     * @param int $notificationChannel
     * @return JsonResponse
     */
    public function delete(Server $server, int $notificationChannel): JsonResponse
    {
        $notificationChannelModel = $server->notificationChannels()
            ->where('id', $notificationChannel)
            ->first();

        if (!$notificationChannelModel) {
            abort(Response::HTTP_NOT_FOUND);
        }

        try {
            $notificationChannelModel->delete();
        } catch (Exception $exception) {
            return $this->exception($exception);
        }

        return $this->json(__('controllers.notification_channel.deleted'));
    }
}