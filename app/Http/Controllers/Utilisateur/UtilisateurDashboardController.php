<?php

namespace App\Http\Controllers\Utilisateur;

use App\Http\Controllers\Controller;


class UtilisateurDashboardController extends Controller
{
    public function dashboard()
    {
        // Logic for handling the Utilisateur dashboard
        return view('utilisateur.dashboard');
    }
}
