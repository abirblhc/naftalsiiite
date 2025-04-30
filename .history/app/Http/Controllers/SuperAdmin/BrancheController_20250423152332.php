<?php
namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;

class BrancheController extends Controller
{
    public function commercialDetails()
    {
        // Récupérer toutes les branches "commercial"
        $commercialBranches = Branche::where('name', 'commercial')->get();

        $details = [];

        // Si les branches "commercial" contiennent des détails
        foreach ($commercialBranches as $branch) {
            if ($branch->details) {
                // Décoder les détails JSON stockés dans la colonne 'details'
                $decoded = json_decode($branch->details, true);
                
                // Ajouter les sous-structures si elles existent
                if (isset($decoded['agence'])) {
                    $details['agence'] = $decoded['agence'];
                }
                if (isset($decoded['LP'])) {
                    $details['LP'] = $decoded['LP'];
                }
                if (isset($decoded['CDD'])) {
                    $details['CDD'] = $decoded['CDD'];
                }
                if (isset($decoded['GD'])) {
                    $details['GD'] = $decoded['GD'];
                }
            }
        }

        // Passer la variable $details à la vue
        return view('superadmin.com', compact('details'));
    }
}