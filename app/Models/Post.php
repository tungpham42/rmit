<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'user_id',
        'course_id',
        'repost_id',
        'post_week',
        'post_title',
        'post_url',
        'post_question',
        'post_answer',
        'post_hide_name',
        'post_current',
    ];

    protected $casts = [
        'post_hide_name' => 'boolean',
        'post_current' => 'boolean',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function repost(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'repost_id', 'post_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'post_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_follows', 'post_id', 'user_id');
    }

    public function voters(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_votes', 'post_id', 'user_id')
            ->withPivot(['post_vote_like', 'post_vote_dislike']);
    }
}
