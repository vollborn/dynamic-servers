<?php

namespace App\Traits\Notifications;

use App\Models\NotificationChannel;
use Illuminate\Support\Str;

trait ValidateNotificationChannelContent
{
    /**
     * @param int $channelType
     * @param string $channelContent
     * @return bool
     */
    protected function validateNotificationChannelContent(int $channelType, string $channelContent): bool
    {
        switch ($channelType) {
            case NotificationChannel::DISCORD:
                if (!Str::startsWith($channelContent, 'https://discord.com/api/webhooks/')) {
                    return false;
                }
                break;
            case NotificationChannel::EMAIL:
                if (!filter_var($channelContent, FILTER_VALIDATE_EMAIL)) {
                    return false;
                }
                break;
        }

        return true;
    }
}