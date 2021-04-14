<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationChannel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'server_id',
        'notification_type_id',
        'content'
    ];

    /**
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
