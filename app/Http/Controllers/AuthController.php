<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    protected AuthService $authService;

    /**
     * Inject AuthService into the controller.
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('Auth.login');
    }

    /**
     * Handle login form submission.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            if ($this->authService->login($request)) {
                return redirect()->route('dashboard');
            }

            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->authService->register($request);

            Auth::login($user);

            return redirect()->route('dashboard');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

