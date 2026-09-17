<?php

namespace App\Repositories\Eloquent;

use App\Models\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }

    public function findByCode(string $code): ?Course
    {
        return $this->model->newQuery()->where('course_code', $code)->first();
    }

    public function openForEnrollment(): Collection
    {
        return $this->model->newQuery()->where('course_allowed', true)->get();
    }
}
