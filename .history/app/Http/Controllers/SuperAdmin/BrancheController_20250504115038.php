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
        // Charger toutes les branches commerciales avec leurs relations
        $commercialBranche = Branche::with(['children' => function($query) {
            $query->with(['children' => function($query) {
                $query->with('children');
            }]);
        }])
        ->where('name', 'Commercial')
        ->first();

        $site = Site::first();

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

        // Debug pour vérifier les branches chargées
        Log::info('Commercial Branche Children:', [
            'children' => $commercialBranche->children->pluck('name')->toArray()
        ]);

        return view('superadmin.com', [
            'commercialBranche' => $commercialBranche,
            'site' => $site
        ]);
    } catch (\Exception $e) {
        Log::error('Error in commercialStructure: ' . $e->getMessage());
        return view('superadmin.com', [
            'commercialBranche' => null,
            'site' => null
        ]);
    }
}



}
