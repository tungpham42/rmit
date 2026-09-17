<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    public function __construct(private readonly RoleRepositoryInterface $roles)
    {
    }

    public function list(): Collection
    {
        return $this->roles->all();
    }

    public function find(int $id): Role
    {
        return $this->roles->findOrFail($id);
    }

    public function create(array $data): Role
    {
        return $this->roles->create($data);
    }

    public function update(Role $role, array $data): Role
    {
        return $this->roles->update($role, $data);
    }

    public function delete(Role $role): bool
    {
        return $this->roles->delete($role);
    }
}
