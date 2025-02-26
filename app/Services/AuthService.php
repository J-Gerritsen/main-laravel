<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthService
{
    /**
     * Handle user registration.
     *
     * @param array $data
     * @return User
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle user login.
     *
     * @param LoginRequest $request
     * @return bool
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        return Auth::attempt($data);
    }
}
