<?php

namespace App\Repositories\Contracts;

use App\Models\Semester;

interface SemesterRepositoryInterface extends RepositoryInterface
{
    public function current(): ?Semester;
}
