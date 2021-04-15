<?php

namespace Database\Seeders;

use App\Models\BackgroundImage;

class BackgroundImageSeeder extends BaseSeeder
{
    protected function getClass(): string
    {
        return BackgroundImage::class;
    }

    protected function getData(): array
    {
        return [
            [
                'storage_path' => '1.jpg',
                'public_path'  => '/backgrounds/1.jpg'
            ]
        ];
    }
}