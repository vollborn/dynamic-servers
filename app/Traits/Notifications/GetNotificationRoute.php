<?php

namespace App\Traits\Notifications;

use App\Models\NotificationChannel;

trait GetNotificationRoute {
    /**
     * @param int $notificationChannelTypeId
     * @return string|null
     */
    protected function getNotificationRoute(int $notificationChannelTypeId): ?string
    {
        switch ($notificationChannelTypeId) {
            case NotificationChannel::DISCORD:
                return 'discord';
            case NotificationChannel::EMAIL:
                return 'mail';
        }

        return null;
    }
}