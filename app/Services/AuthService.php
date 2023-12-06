<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public function createUser(string $login, string $password): User
    {
        $user = User::create([
            'login' => $login,  // Include the login field
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return $user;
    }
}
