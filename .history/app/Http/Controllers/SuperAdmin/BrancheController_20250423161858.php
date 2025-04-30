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
        return view('superadmin.com');
    }
}
