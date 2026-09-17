<?php

namespace App\Services;

use App\Models\Semester;
use App\Repositories\Contracts\SemesterRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SemesterService
{
    public function __construct(private readonly SemesterRepositoryInterface $semesters)
    {
    }

    public function list(): Collection
    {
        return $this->semesters->all();
    }

    public function current(): ?Semester
    {
        return $this->semesters->current();
    }

    public function find(int $id): Semester
    {
        return $this->semesters->findOrFail($id);
    }

    public function create(array $data): Semester
    {
        return $this->semesters->create($data);
    }

    public function update(Semester $semester, array $data): Semester
    {
        return $this->semesters->update($semester, $data);
    }

    public function delete(Semester $semester): bool
    {
        return $this->semesters->delete($semester);
    }
}
