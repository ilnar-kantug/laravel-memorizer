<?php

namespace App\Http\ViewComposers;

use App\Entity\User;
use Illuminate\View\View;

class LoginComposer
{
    public function compose(View $view)
    {
        //TODO - REMOVE THIS FUNCTIONALITY BEFORE REAL RELEASE
        $users = $this->getUsersWithPass();
        $view->with('users', $users);
    }

    private function getUsersWithPass()
    {
        $users = User::select('email')->where('name', '!=', 'admin')->get()->toArray();
        foreach ($users as $user) {
            $user['password'] = 'secret';
            $users_with_pass[] = $user;
        }
        return $users_with_pass;
    }
}
