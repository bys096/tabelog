<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function exists(string $name): bool
    {
        if (! $this->userRepository->findByName($name)) {
            return false;
        }
        return true;
    }

    public function store(string $name, string $email, string $password): int
    {
        return $this->userRepository->store(new User(null, $name, $email, $password));
    }
}
