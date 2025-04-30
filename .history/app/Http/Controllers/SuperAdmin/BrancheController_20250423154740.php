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
        // Get commercial branches with their sites
        $commercialBranches = Branche::with('site')
            ->where('name', 'commercial')
            ->get();

        $branchDetails = [];

        foreach ($commercialBranches as $branch) {
            if ($branch->site) {
                $siteName = $branch->site->name;
                $details = $branch->details;

                // If details is a JSON string, decode it
                if (is_string($details)) {
                    $details = json_decode($details, true);
                }

                // Initialize the site's details if not already set
                if (!isset($branchDetails[$siteName])) {
                    $branchDetails[$siteName] = [
                        'site' => $branch->site,
                        'details' => []
                    ];
                }

                // Add or update the details for this site
                if (is_array($details)) {
                    $branchDetails[$siteName]['details'] = array_merge(
                        $branchDetails[$siteName]['details'],
                        array_filter([
                            'agence' => $details['agence'] ?? null,
                            'LP' => $details['LP'] ?? null,
                            'CDD' => $details['CDD'] ?? null,
                            'GD' => $details['GD'] ?? null
                        ])
                    );
                }
            }
        }

        return view('superadmin.com', compact('branchDetails'));
    }
}
