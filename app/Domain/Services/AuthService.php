<?php

namespace App\Domain\Services;

use App\Domain\Repository\UserRepositoryInterface;
use Illuminate\Auth\AuthManager;

class AuthService
{
    private $userRepository;
    private $authManager;

    public function __construct(UserRepositoryInterface $userRepository, AuthManager $authManager)
    {
        $this->userRepository = $userRepository;
        $this->authManager = $authManager;
    }


}
