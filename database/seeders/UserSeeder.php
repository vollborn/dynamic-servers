<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        return [
            [
                'salutation' => 'Herr',
                'first_name' => 'Oliver',
                'last_name'  => 'Vollborn',
                'username'   => 'webmaster',
                'password'   => Hash::make('change'),
                'api_token'  => 'test'
            ],
            [
                'salutation' => 'Herr2',
                'first_name' => 'Oliver2',
                'last_name'  => 'Vollborn2',
                'username'   => 'webmaster2',
                'password'   => Hash::make('change'),
                'api_token'  => 'test2'
            ]
        ];
    }
}
