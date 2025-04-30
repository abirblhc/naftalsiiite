<?php
namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
use App\Models\Site;

class BrancheController extends Controller
{
    public function carburantSites()
    {
        // Get unique sites that have carburant branches
        $carburantBranches = Branche::with('site')
            ->where('name', 'carburant')
            ->get();

        return view('superadmin.cbr', compact('carburantBranches'));
    }

    public function commercialDetails()
    {
        // Get commercial branches with their sites
        $commercialBranches = Branche::with('site')
            ->where('name', 'commercial')
            ->get();

        $branchDetails = [];

        foreach ($commercialBranches as $branch) {
            if ($branch->site) {
                $siteName = $branch->site->name;
                $details = $branch->details;

                // Si details est une chaîne JSON, la décoder
                if (is_string($details)) {
                    $details = json_decode($details, true) ?? [];
                }

                // Si details est null, initialiser comme tableau vide
                if (is_null($details)) {
                    $details = [];
                }

                // Initialiser les détails du site s'ils n'existent pas
                if (!isset($branchDetails[$siteName])) {
                    $branchDetails[$siteName] = [
                        'site' => $branch->site,
                        'details' => []
                    ];
                }

                // Ajouter ou mettre à jour les détails pour ce site
                $branchDetails[$siteName]['details'] = [
                    'agence' => $details['agence'] ?? null,
                    'LP' => $details['LP'] ?? null,
                    'CDD' => $details['CDD'] ?? null,
                    'GD' => $details['GD'] ?? null
                ];
            }
        }

        // Assurez-vous que $branchDetails est un array même s'il est vide
        $branchDetails = $branchDetails ?: [];

        return view('superadmin.com', compact('branchDetails'));
    }
}
