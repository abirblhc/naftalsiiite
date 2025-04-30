<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $credentials['email'] = strtolower($credentials['email']);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                $user = Auth::user();
                if ($user->role === 'admin') {
                    return redirect()->intended(RouteServiceProvider::ADMIN);
                } elseif ($user->role === 'manager') {
                    return redirect()->intended(RouteServiceProvider::MANAGER);
                } else {
                    return redirect()->intended(RouteServiceProvider::HOME);
                }
            }

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Les identifiants fournis sont incorrects.',
            ])->withInput($request->except('password'));
        }
    }
}
