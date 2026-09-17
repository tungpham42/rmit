<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'post_id',
        'user_id',
        'comment_body',
        'comment_hide_name',
    ];

    protected $casts = [
        'comment_hide_name' => 'boolean',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function voters(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'comment_votes', 'comment_id', 'user_id')
            ->withPivot(['comment_vote_like', 'comment_vote_dislike']);
    }
}
