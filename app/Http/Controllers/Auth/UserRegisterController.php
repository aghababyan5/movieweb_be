<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserRegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(UserRequest $request
    ): \Illuminate\Http\JsonResponse {
        $this->userService->store($request->validated());

        return response()->json(['message' => 'User created successfully']);
    }
}
