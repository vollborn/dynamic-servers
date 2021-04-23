<?php

namespace App\Http\Controllers\Api\BackgroundImage;

use App\Http\Resources\BackgroundImageResource;
use App\Models\BackgroundImage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BackgroundImageController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $backgroundImages = BackgroundImage::all();
        return BackgroundImageResource::collection($backgroundImages);
    }
}