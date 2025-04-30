<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Convertir l'email en minuscules
        $email = strtolower($this->email);
        $password = $this->password;

        // Vérifier si l'utilisateur existe
        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            Log::info('Tentative de connexion : utilisateur non trouvé', ['email' => $email]);
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => "Aucun compte trouvé avec cet email. Vérifiez que vous avez saisi la bonne adresse email.",
            ]);
        }

        // Vérification directe du mot de passe
        if (!Hash::check($password, $user->password)) {
            Log::info('Tentative de connexion : mot de passe incorrect', ['email' => $email]);
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'password' => "Le mot de passe est incorrect. Veuillez vérifier votre mot de passe et réessayer.",
            ]);
        }

        // Si le mot de passe est correct, connecter l'utilisateur
        Auth::login($user, $this->boolean('remember'));

        Log::info('Connexion réussie', ['email' => $email]);
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
