<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function findById(int $userId);

    public function findByEmailWithTrashed(string $email);

    public function store(User $user): int;

    public function findByEmailAndPassword(string $email, string $password): ?User;

}
