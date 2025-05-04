<?php
namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
use App\Models\Site;
use Illuminate\Support\Facades\Log;

class BrancheController extends Controller
{
    public function carburantSites()
    {
        // Get unique sites that have carburant branches
        $carburantBranches = Branche::with('site')
            ->where('name', 'carburant')
            ->get()
            ->unique('site_id')
            ->values(); // Réindexer le tableau après unique()

        return view('superadmin.cbr', compact('carburantBranches'));
    }

// SuperAdmin/BrancheController.php
public function commercialDetails()
{
    $stations = Site::whereHas('branche', function($q) {
        $q->where('name', 'commercial');
    })
    ->with('children') // Load children directly
    ->whereNull('parent_id') // Only GD (top level) stations, no child stations alone
    ->get();

    return view('superadmin.com', compact('stations'));
}
public function commercialStructure()
{
    try {
        $commercialBranche = Branche::with(['children.children.children'])
            ->where('name', 'Commercial')
            ->first();

        $site = Site::first(); // à adapter selon ta logique

        if (!$commercialBranche) {
            return view('superadmin.com', [
                'commercialBranche' => null,
                'site' => $site
            ]);
        }

        // Vérifier que la branche a des enfants
        if (!$commercialBranche->children || $commercialBranche->children->isEmpty()) {
            return view('superadmin.com', [
                'commercialBranche' => null,
                'site' => $site
            ]);
        }

        return view('superadmin.com', [
            'commercialBranche' => $commercialBranche,
            'site' => $site
        ]);
    } catch (\Exception $e) {
        \Log::error('Error in commercialStructure: ' . $e->getMessage());
        return view('superadmin.com', [
            'commercialBranche' => null,
            'site' => null
        ]);
    }
}



}
