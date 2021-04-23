<?php

namespace Database\Seeders;

use App\Models\BackgroundImage;
use Illuminate\Support\Facades\Storage;

class BackgroundImageSeeder extends BaseSeeder
{
    protected function getClass(): string
    {
        return BackgroundImage::class;
    }

    protected function getData(): array
    {
        $files = collect(Storage::disk('backgrounds')->files())
            ->map(static function ($item) {
                return [
                    'storage_path' => $item,
                    'public_path'  => '/assets/backgrounds/' . $item
                ];
            });

        return $files->toArray();
    }
}