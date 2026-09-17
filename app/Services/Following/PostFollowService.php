<?php

namespace App\Services\Following;

use App\Models\PostFollow;

class PostFollowService extends AbstractFollowService
{
    protected function modelClass(): string
    {
        return PostFollow::class;
    }

    protected function targetKey(): string
    {
        return 'post_id';
    }
}
