<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'         => $this->id,
            'salutation' => $this->salutation,
            'firstName'  => $this->first_name,
            'lastName'   => $this->last_name,
            'username'   => $this->username,
            'createdAt'  => $this->created_at,
            'updatedAt'  => $this->updated_at,

            'servers' => ServerResource::collection($this->whenLoaded('servers'))
        ];
    }
}
