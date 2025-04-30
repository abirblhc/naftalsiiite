<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $sites = \App\Models\Site::all();
        $branches = \App\Models\Branche::select('name')->distinct()->get();
        return view('auth.register', compact('sites', 'branches'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'site_id' => ['required', 'exists:sites,id'],
            'branche_name' => ['required', 'in:carburant,commercial'],
        ]);

        // Trouve la branche correspondant au nom
        $branche = \App\Models\Branche::where('name', $request->branche_name)->first();

        // Préparer les données de l'utilisateur
        $userData = [
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => $request->password,
            'role' => 'utilisateur',
            'site_id' => $request->site_id,
            'branche_id' => $branche->id,
        ];

        try {
            $user = User::create($userData);

            event(new Registered($user));

            // Connecter directement l'utilisateur
            Auth::login($user);

            $request->session()->regenerate();

            // Redirection en fonction du rôle
            return redirect()->intended(
                route($user->role === 'utilisateur' ? 'utilisateur.dashboard' : 'dashboard')
            );

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['email' => 'Une erreur est survenue lors de la création du compte. Veuillez réessayer.']);
        }
    }
}
