<?php

namespace App\UseCases\Auth;

use App\Entity\User;

class RegisterService
{
    public function verifyUser(User $user)
    {
        $user->verify_token = null;
        $user->status = User::STATUS_ACTIVE;
        $user->save();
    }
}
