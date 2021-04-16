<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class NotificationChannel extends Model
{
    use SoftDeletes,
        Notifiable;

    public const DISCORD = 1;
    public const EMAIL = 2;

    protected $fillable = [
        'server_id',
        'notification_channel_type_id',
        'content',
        'deleted_at'
    ];

    /**
     * @return int[]
     */
    public static function getAvailable(): array
    {
        return [
            self::DISCORD,
            self::EMAIL
        ];
    }

    /**
     * @param $driver
     * @param null $notification
     * @return mixed
     */
    public function routeNotificationFor($driver, $notification = null)
    {
        return $this->content;
    }

    /**
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
