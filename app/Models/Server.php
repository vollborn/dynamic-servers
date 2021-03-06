<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Server extends Model
{
    use SoftDeletes,
        CascadesDeletes;

    protected array $cascadeDeletes = [
        'notificationChannels',
        'statistics'
    ];

    protected $fillable = [
        'user_id',
        'notification_channel_limit',
        'name',
        'ip_address',
        'ip_address_details',
        'server_token',
        'request_token',
        'request_interval',
        'custom_labels',
        'background_image_id',
        'last_seen_at',
        'last_updated_at'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('own', function (Builder $builder) {
            $builder->where('user_id', Auth::id());
        });
    }

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
