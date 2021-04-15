<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticResource extends JsonResource
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
            'id'            => $this->id,
            'requestsCount' => $this->requests_count,
            'countingAt'    => $this->counting_at,
            'createdAt'     => $this->created_at,
            'updatedAt'     => $this->updated_at,

            'serverId' => $this->background_image_id,
            'server'   => new BackgroundImageResource($this->whenLoaded('backgroundImage'))
        ];
    }
}
