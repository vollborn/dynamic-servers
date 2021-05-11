<?php

return [
    'store' => [
        'invalid_channel_content' => 'Der Kanalinhalt ist nicht zulässig.'
    ],

    'discord' => [
        'name' => 'Discord',

        'status' => [
            'text' => 'Hier die neue IP-Adresse für dich!'
        ]
    ],

    'mail' => [
        'name' => 'E-Mail',

        'greeting'   => 'Hallo!',
        'salutation' => 'Beste Grüße<br />' . env('APP_NAME'),

        'status' => [
            'before_server' => 'Die IP-Adresse des Servers "',
            'after_server'  => '" wurde aktualisiert.'
        ]
    ]
];