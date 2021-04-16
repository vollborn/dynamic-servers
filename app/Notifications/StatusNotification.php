<?php

namespace App\Notifications;

use App\Models\Server;
use App\Traits\Notifications\GetNotificationRoute;
use Awssat\Notifications\Messages\DiscordMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusNotification extends Notification
{
    use Queueable,
        GetNotificationRoute;

    protected Server $server;

    /**
     * StatusNotification constructor.
     * @param \App\Models\Server $server
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**
     * @return string[]
     */
    public function via($notifiable): array
    {
        return [
            $this->getNotificationRoute($notifiable->notification_channel_type_id)
        ];
    }

    /**
     * @param $notifiable
     * @return \Awssat\Notifications\Messages\DiscordMessage
     */
    public function toDiscord($notifiable): DiscordMessage
    {
        return (new DiscordMessage)
            ->from(env('APP_NAME'), 'https://i.imgur.com/wSTFkRM.png')
            ->embed(function ($embed) {
                $text = __('notifications.discord.status.text');
                $textData = [
                    '**Server**' => $this->server->name,
                    '**IP**'     => $this->server->ip_address
                ];

                $embed->title($this->server->name)
                    ->description($text);

                foreach ($textData as $key => $value) {
                    $embed->field($key, $value);
                }
            });
    }
}
