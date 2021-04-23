<?php

namespace App\Notifications;

use App\Models\Server;
use App\Traits\Notifications\GetNotificationRoute;
use Awssat\Notifications\Messages\DiscordMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(): MailMessage
    {
        $greeting = __('notifications.mail.greeting');
        $salutation = __('notifications.mail.salutation');

        $text = __('notifications.mail.status.before_server')
            . $this->server->name
            . __('notifications.mail.status.after_server')
            . '<br />'
            . '<br /><strong>Server</strong>: ' . $this->server->name
            . '<br /><strong>IP</strong>: ' . $this->server->ip_address;

        return (new MailMessage)
            ->greeting(new HtmlString($greeting))
            ->line(new HtmlString($text))
            ->salutation(new HtmlString($salutation));
    }

    /**
     * @return \Awssat\Notifications\Messages\DiscordMessage
     */
    public function toDiscord(): DiscordMessage
    {
        return (new DiscordMessage)
            ->from(env('APP_NAME'), env('APP_URL') . '/assets/logo.png')
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
