<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;
use App\Domain\Models\User as EloquentUser;
use App\Domain\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $eloquentUser;

    public function __construct(EloquentUser $eloquentUser)
    {
        $this->eloquentUser = $eloquentUser;
    }

    public function findByEmail(string $email): ?User
    {
        $record = $this->eloquentUser->where('email', $email)->first();
        if ($record === null) {
            return null;
        }
        return new User(
            $record->id,
            $record->name,
            $record->email,
            $record->password
        );
    }

    public function store(User $user): int
    {
        $eloquent = $this->eloquentUser->newInstance();
        $eloquent->name = $user->getName();
        $eloquent->email = $user->getEmail();
        $eloquent->password = $user->getPassword();
        $eloquent->save();

        return (int) $eloquent->id;
    }
}
