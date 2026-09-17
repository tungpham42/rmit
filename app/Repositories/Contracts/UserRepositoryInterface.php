<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByUsername(string $name): ?User;

    public function findByEmail(string $email): ?User;
}
