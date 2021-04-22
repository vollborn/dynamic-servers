<?php

use App\Models\NotificationChannel;

return [

    // Array of enabled notification channel types
    'enabled' => [
        NotificationChannel::DISCORD,
        NotificationChannel::EMAIL
    ],

];