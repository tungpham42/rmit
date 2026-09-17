<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function forCourse(int $courseId): Collection;

    public function search(string $term): Collection;
}
