<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BackgroundImage extends Model
{
    protected $fillable = [
        'storage_path',
        'public_path'
    ];

    /**
     * @return HasMany
     */
    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }
}
