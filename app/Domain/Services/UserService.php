<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
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

    public function exists(string $email): bool
    {
        if ($this->userRepository->findByEmail($email)) {
            return true;
        }
        return false;
    }

    public function store(string $name, string $email, string $password): int
    {
        return $this->userRepository->store(new User(null, $name, $email, $password));
//        try {
//        } catch (QueryException $e) {
//            $errorCode = $e->getCode();
//            Log::info('Query Exception Occured. error-code: ' . $errorCode);
//            if ($errorCode == 23000) {
//                throw new DuplicateUserException(view('errors.page'), 'Duplicate User Error', $errorCode);
//            }
//        }
//        return 0;
    }

}
