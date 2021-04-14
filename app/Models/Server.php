<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'ip_address',
        'ip_address_details',
        'server_token',
        'request_token',
        'custom_labels',
        'background_image_id',
        'request_limit',
        'request_maximal_interval',
        'last_updated_at'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function backgroundImage(): BelongsTo
    {
        return $this->belongsTo(BackgroundImage::class);
    }

    /**
     * @return HasMany
     */
    public function statistics(): HasMany
    {
        return $this->hasMany(Statistic::class);
    }

    /**
     * @return HasMany
     */
    public function notificationChannels(): HasMany
    {
        return $this->hasMany(NotificationChannel::class);
    }
}
