<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

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

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
    }

    public function getAuthUser()
    {
        return auth()->user();
    }
}
