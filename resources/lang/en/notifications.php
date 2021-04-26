<?php

return [
    'store' => [
        'invalid_channel_content' => 'The channel content is not valid.'
    ],

    'discord' => [
        'name' => 'Discord',

        'status' => [
            'text' => 'Got a new IP address for you!'
        ]
    ],

    'mail' => [
        'name' => 'E-Mail',

        'greeting'   => 'Hey there!',
        'salutation' => 'Regards,<br />' . env('APP_NAME'),

        'status' => [
            'before_server' => 'The IP address of the server "',
            'after_server'  => '" got updated.'
        ]
    ]
];