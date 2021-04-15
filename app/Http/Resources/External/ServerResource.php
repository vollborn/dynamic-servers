<?php

namespace App\Http\Resources\External;

use App\Http\Resources\BackgroundImageResource;
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
            'ipAddress'        => $this->ip_address,
            'ipAddressDetails' => $this->decodeJson($this->ip_address_details),
            'customLabels'     => $this->custom_labels,
            'lastSeenAt'       => $this->last_seen_at,
            'lastUpdatedAt'    => $this->last_updated_at,

            'backgroundImageId' => $this->background_image_id,
            'backgroundImage'   => new BackgroundImageResource($this->whenLoaded('backgroundImage'))
        ];
    }
}
