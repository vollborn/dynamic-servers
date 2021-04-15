<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationChannelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                        => $this->id,
            'notificationChannelTypeId' => $this->notification_channel_type_id,
            'content'                   => $this->content,
            'createdAt'                 => $this->created_at,
            'updatedAt'                 => $this->updated_at,

            'serverId' => $this->server_id,
            'server'   => new ServerResource($this->whenLoaded('server'))
        ];
    }
}
