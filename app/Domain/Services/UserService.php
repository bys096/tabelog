<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Enums\UserStatus;
use App\Exceptions\DuplicateUserException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function checkEmailStatus(string $email): int
    {
        $user = $this->userRepository->findByEmailWithTrashed($email);

        if ($user == null) {
            return UserStatus::USER_AVAILABLE;
        } else if ($user->trashed()) {
            return UserStatus::USER_DELETED;
        } else {
//            throw new DuplicateUserException();
            return UserStatus::USER_EXIST;
        }
    }

    public function store(string $name, string $email, string $password): int
    {
        try {
            return $this->userRepository->store(new User(null, $name, $email, $password));
        } catch (QueryException) {
            throw new DuplicateUserException;
        }
    }

}
