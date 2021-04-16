<?php

namespace Database\Seeders;

use App\Models\User;

class UserSeeder extends BaseSeeder
{
    /**
     * @return string
     */
    protected function getClass(): string
    {
        return User::class;
    }

    /**
     * @return array[]
     */
    protected function getData(): array
    {
        return [];
    }
}
