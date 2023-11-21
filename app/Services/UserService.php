<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function store(array $data)
    {
        return User::query()->create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }
}
