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
            ->get()
            ->unique('site_id');

        return view('superadmin.cbr', compact('carburantBranches'));
    }

    public function commercialDetails()
    {
        // Get commercial branches with their sites and details
        $commercialBranches = Branche::with('site')
            ->where('name', 'commercial')
            ->get()
            ->unique('site_id');

        $branchDetails = [];
        foreach ($commercialBranches as $branch) {
            if ($branch->details) {
                $details = is_array($branch->details) ? $branch->details : json_decode($branch->details, true);
                $branchDetails[$branch->site->name] = [
                    'site' => $branch->site,
                    'details' => array_filter([
                        'agence' => $details['agence'] ?? null,
                        'LP' => $details['LP'] ?? null,
                        'CDD' => $details['CDD'] ?? null,
                        'GD' => $details['GD'] ?? null
                    ])
                ];
            }
        }

        return view('superadmin.com', compact('branchDetails'));
    }
}
