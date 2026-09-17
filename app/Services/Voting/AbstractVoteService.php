<?php

namespace App\Services\Voting;

use Illuminate\Database\Eloquent\Model;

/**
 * Encapsulates the like/dislike toggle logic shared by post votes and comment votes.
 * Concrete services only declare which model/columns to operate on (DRY + OCP).
 */
abstract class AbstractVoteService
{
    abstract protected function modelClass(): string;

    abstract protected function ownerKey(): string;

    abstract protected function likeColumn(): string;

    abstract protected function dislikeColumn(): string;

    public function like(int $ownerId, int $userId): Model
    {
        return $this->vote($ownerId, $userId, true, false);
    }

    public function dislike(int $ownerId, int $userId): Model
    {
        return $this->vote($ownerId, $userId, false, true);
    }

    public function clear(int $ownerId, int $userId): void
    {
        $this->modelClass()::query()
            ->where($this->ownerKey(), $ownerId)
            ->where('user_id', $userId)
            ->delete();
    }

    protected function vote(int $ownerId, int $userId, bool $like, bool $dislike): Model
    {
        $modelClass = $this->modelClass();

        return $modelClass::query()->updateOrCreate(
            [$this->ownerKey() => $ownerId, 'user_id' => $userId],
            [$this->likeColumn() => $like, $this->dislikeColumn() => $dislike]
        );
    }
}
