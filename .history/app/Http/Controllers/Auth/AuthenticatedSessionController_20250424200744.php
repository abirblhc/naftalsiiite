<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $credentials['email'] = strtolower($credentials['email']);

            // Récupérer l'utilisateur pour le débogage
            $user = User::where('email', $credentials['email'])->first();

            if (!$user) {
                Log::info('Tentative de connexion : utilisateur non trouvé', ['email' => $credentials['email']]);
                throw ValidationException::withMessages([
                    'email' => 'Aucun compte trouvé avec cette adresse email.',
                ]);
            }

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

            Log::info('Échec de connexion : mot de passe incorrect', ['email' => $credentials['email']]);
            throw ValidationException::withMessages([
                'password' => 'Le mot de passe est incorrect.',
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => $e->getMessage(),
            ])->withInput($request->except('password'));
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
