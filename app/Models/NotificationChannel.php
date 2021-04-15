<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationChannel extends Model
{
    use SoftDeletes;

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
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
