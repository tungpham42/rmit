<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseService
{
    public function __construct(private readonly CourseRepositoryInterface $courses)
    {
    }

    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return $this->courses->paginate($perPage);
    }

    public function find(int $id): Course
    {
        return $this->courses->findOrFail($id);
    }

    public function create(array $data): Course
    {
        return $this->courses->create($data);
    }

    public function update(Course $course, array $data): Course
    {
        return $this->courses->update($course, $data);
    }

    public function delete(Course $course): bool
    {
        return $this->courses->delete($course);
    }
}
