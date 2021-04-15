<?php

namespace App\Http\Resources;

use App\Traits\Functions\DecodeJson;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'         => $this->id,
            'firstName'  => $this->first_name,
            'lastName'   => $this->last_name,
            'username'   => $this->username,
            'settings'   => $this->decodeJson($this->settings),
            'createdAt'  => $this->created_at,
            'updatedAt'  => $this->updated_at,

            'servers' => ServerResource::collection($this->whenLoaded('servers'))
        ];
    }
}
