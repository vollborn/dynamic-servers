<?php

namespace App\Http\Resources;

use App\Traits\Functions\DecodeJson;
use App\Traits\User\DefaultSettings;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    use DecodeJson,
        DefaultSettings;

    /**
     * Transform the resource into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'firstName'   => $this->first_name,
            'lastName'    => $this->last_name,
            'username'    => $this->username,
            'settings'    => $this->decodeJson($this->settings) ?? $this->getDefaultSettings(),
            'apiToken'    => $this->api_token,
            'serverLimit' => $this->server_limit,
            'createdAt'   => $this->created_at,
            'updatedAt'   => $this->updated_at,

            'servers' => ServerResource::collection($this->whenLoaded('servers'))
        ];
    }
}
