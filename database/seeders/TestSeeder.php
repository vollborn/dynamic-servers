<?php

namespace Database\Seeders;

use App\Models\NotificationChannel;
use App\Models\Server;
use App\Models\User;
use App\Traits\Server\VerifyCustomLabels;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestSeeder extends Seeder
{
    use VerifyCustomLabels;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getUsers() as $data) {
            $user = User::firstOrCreate($data);
            $user->forceFill(['api_token' => $data['api_token']]);
            $user->save();
        }

        foreach ($this->getServers() as $data) {
            Server::firstOrCreate($data);
        }

        foreach ($this->getNotificationChannels() as $data) {
            NotificationChannel::firstOrCreate($data);
        }
    }

    /**
     * @return array
     */
    protected function getUsers(): array
    {
        return [
            [
                'first_name' => 'Oliver',
                'last_name'  => 'Vollborn',
                'username'   => 'webmaster',
                'password'   => Hash::make('change'),
                'api_token'  => 'test'
            ],
            [
                'first_name' => 'Oliver2',
                'last_name'  => 'Vollborn2',
                'username'   => 'webmaster2',
                'password'   => Hash::make('change'),
                'api_token'  => 'test2'
            ]
        ];
    }

    protected function getServers(): array
    {
        return [
            [
                'user_id'             => 1,
                'name'                => 'Testserver',
                'server_token'        => Str::random(config('servers.server_token_length')),
                'request_token'       => Str::random(config('servers.request_token_length')),
                'custom_labels'       => $this->verifyCustomLabels(null),
                'background_image_id' => config('servers.default.background_image_id'),
                'request_interval'    => config('servers.request_interval_min')
            ]
        ];
    }

    protected function getNotificationChannels(): array
    {
        return [
            [
                'server_id'                    => 1,
                'notification_channel_type_id' => NotificationChannel::DISCORD,
                'content'                      => 'http://localhost'
            ],
            [
                'server_id'                    => 1,
                'notification_channel_type_id' => NotificationChannel::EMAIL,
                'content'                      => 'dev@dev.de'
            ]
        ];
    }
}
