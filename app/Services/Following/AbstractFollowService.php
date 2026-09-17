<?php

namespace App\Services\Following;

/**
 * Encapsulates the follow/unfollow toggle logic shared by post follows and user follows.
 */
abstract class AbstractFollowService
{
    abstract protected function modelClass(): string;

    abstract protected function targetKey(): string;

    public function follow(int $userId, int $targetId): void
    {
        $modelClass = $this->modelClass();

        $modelClass::query()->firstOrCreate([
            'user_id' => $userId,
            $this->targetKey() => $targetId,
        ]);
    }

    public function unfollow(int $userId, int $targetId): void
    {
        $this->modelClass()::query()
            ->where('user_id', $userId)
            ->where($this->targetKey(), $targetId)
            ->delete();
    }

    public function isFollowing(int $userId, int $targetId): bool
    {
        return $this->modelClass()::query()
            ->where('user_id', $userId)
            ->where($this->targetKey(), $targetId)
            ->exists();
    }
}
