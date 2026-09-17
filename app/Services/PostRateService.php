<?php

namespace App\Services;

use App\Models\PostRate;

class PostRateService
{
    public function rate(int $postId, int $userId, bool $value): PostRate
    {
        return PostRate::query()->updateOrCreate(
            ['post_id' => $postId, 'user_id' => $userId],
            ['post_rate' => $value]
        );
    }

    public function clear(int $postId, int $userId): void
    {
        PostRate::query()
            ->where('post_id', $postId)
            ->where('user_id', $userId)
            ->delete();
    }
}
