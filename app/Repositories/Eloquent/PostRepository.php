<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function forCourse(int $courseId): Collection
    {
        return $this->model->newQuery()->where('course_id', $courseId)->get();
    }

    public function search(string $term): Collection
    {
        return $this->model->newQuery()
            ->whereFullText(['post_title', 'post_question', 'post_answer'], $term)
            ->get();
    }
}
