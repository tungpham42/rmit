<?php

namespace App\Repositories\Contracts;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

interface CourseRepositoryInterface extends RepositoryInterface
{
    public function findByCode(string $code): ?Course;

    public function openForEnrollment(): Collection;
}
