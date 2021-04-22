<?php

namespace App\Http\Controllers\Api\NotificationChannelType;

use App\Http\Controllers\Controller;
use App\Models\NotificationChannel;

class NotificationChannelTypeController extends Controller
{
    /**
     * @return array
     */
    public function index(): array
    {
        $channels = [];
        $this->appendChannel($channels, NotificationChannel::DISCORD, 'notifications.discord.name');
        $this->appendChannel($channels, NotificationChannel::EMAIL, 'notifications.mail.name');
        return $channels;
    }

    /**
     * @param array $channels
     * @param int $channelType
     * @param string $translationKey
     */
    protected function appendChannel(array &$channels, int $channelType, string $translationKey)
    {
        if (!in_array($channelType, config('notifications.enabled'), true)) {
            return;
        }

        $channels[] = [
            'id'   => $channelType,
            'name' => __($translationKey)
        ];
    }
}