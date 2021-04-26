<?php

namespace App\Http\Resources;

use App\Traits\Functions\DecodeJson;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ServerResource extends JsonResource
{
    use DecodeJson;

    /**
     * Transform the resource into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                       => $this->id,
            'name'                     => $this->name,
            'notificationChannelLimit' => $this->notification_channel_limit,
            'ipAddress'                => $this->ip_address,
            'ipAddressDetails'         => $this->decodeJson($this->ip_address_details),
            'serverToken'              => $this->server_token,
            'requestToken'             => $this->request_token,
            'customLabels'             => $this->decodeJson($this->custom_labels) ?? $this->getDefaultLabels(),
            'requestInterval'          => $this->request_interval,
            'lastSeenAt'               => $this->last_seen_at,
            'lastUpdatedAt'            => $this->last_updated_at,
            'createdAt'                => $this->created_at,
            'updatedAt'                => $this->updated_at,
            'disabledAt'               => $this->disabled_at,

            'isAvailable' => $this->getAvailability(),

            'notificationChannels' => NotificationChannelResource::collection($this->whenLoaded('notificationChannels')),
            'backgroundImageId'    => $this->background_image_id,
            'backgroundImage'      => new BackgroundImageResource($this->whenLoaded('backgroundImage')),
            'userId'               => $this->user_id,
            'user'                 => new UserResource($this->whenLoaded('user'))
        ];
    }

    /**
     * @return bool
     */
    protected function getAvailability(): bool
    {
        if (!$this->last_seen_at) {
            return false;
        }

        if (Carbon::parse($this->last_seen_at)->addMilliseconds($this->request_interval)->isBefore(now())) {
            return false;
        }

        return true;
    }

    /**
     * @return null[]
     */
    protected function getDefaultLabels(): array
    {
        return [
            'title'    => null,
            'subtitle' => null,
            'text'     => null
        ];
    }
}
