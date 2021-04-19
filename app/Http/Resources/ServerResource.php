<?php

namespace App\Http\Resources;

use App\Traits\Functions\DecodeJson;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id'               => $this->id,
            'name'             => $this->name,
            'ipAddress'        => $this->ip_address,
            'ipAddressDetails' => $this->decodeJson($this->ip_address_details),
            'serverToken'      => $this->server_token,
            'requestToken'     => $this->request_token,
            'customLabels'     => $this->custom_labels,
            'requestInterval'  => $this->request_interval,
            'lastSeenAt'       => $this->last_seen_at,
            'lastUpdatedAt'    => $this->last_updated_at,
            'createdAt'        => $this->created_at,
            'updatedAt'        => $this->updated_at,

            'notificationChannels' => NotificationChannelResource::collection($this->whenLoaded('notificationChannels')),
            'backgroundImageId'    => $this->background_image_id,
            'backgroundImage'      => new BackgroundImageResource($this->whenLoaded('backgroundImage')),
            'userId'               => $this->user_id,
            'user'                 => new UserResource($this->whenLoaded('user'))
        ];
    }
}
