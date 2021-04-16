<?php

return [
    'discord' => [
        'status' => [
            'text' => 'Got a new IP address for you!'
        ]
    ],

    'mail' => [
        'greeting'   => 'Hey there!',
        'salutation' => 'Regards,<br />' . env('APP_NAME'),

        'status' => [
            'before_server' => 'The IP address of the server "',
            'after_server'  => '" got updated.'
        ]
    ]
];