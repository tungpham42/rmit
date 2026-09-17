<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface extends RepositoryInterface
{
    public function forPost(int $postId): Collection;
}
