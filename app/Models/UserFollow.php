<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFollow extends Model
{
    protected $fillable = [
        'user_id',
        'followee_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function followee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'followee_id', 'user_id');
    }
}
