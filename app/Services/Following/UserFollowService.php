<?php

namespace App\Services\Following;

use App\Models\UserFollow;

class UserFollowService extends AbstractFollowService
{
    protected function modelClass(): string
    {
        return UserFollow::class;
    }

    protected function targetKey(): string
    {
        return 'followee_id';
    }
}
