<?php

namespace App\Policies;

use App\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, User $user_model)
    {
        return $user->id == $user_model->id;
    }

    public function __construct()
    {
        //
    }
}
