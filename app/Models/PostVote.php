<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostVote extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'post_vote_like',
        'post_vote_dislike',
    ];

    protected $casts = [
        'post_vote_like' => 'boolean',
        'post_vote_dislike' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }
}
