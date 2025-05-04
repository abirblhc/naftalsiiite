<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Branche;

class SiteController extends Controller
{

    public function showBranches($id, $brancheType)
    {
        $site = Site::findOrFail($id);

        $branche = $site->branches()
                        ->where('name', $brancheType)
                        ->whereNull('parent_id')
                        ->with('children')
                        ->firstOrFail();

                        return view('superadmin.branches.show', compact('site', 'brancheType'));

    }

    public function showCarburant(Site $site)
    {
        return view('sites.carburant', [
            'site' => $site,
            'isSiege' => $site->name === 'Siege'
        ]);
    }

    public function showCommercial(Site $site)
    {
        return view('sites.commercial', [
            'site' => $site,
            'branche' => $site->branches()
                             ->where('name', 'Commercial')
                             ->firstOrFail()
        ]);
    }

    public function showAgence(Site $site)
    {
        return view('sites.agence', ['site' => $site]);
    }


    public function showSite(Site $site, $branchType = null, Branche $branch = null)
{
    $data = [
        'site' => $site,
        'branchType' => $branchType,
        'branch' => $branch
    ];

    // Special cases
    if ($branchType === 'agence') {
        $data['showAgencePlan'] = $site->name === 'Siege';
    }
    elseif ($branchType === 'carburant') {
        $data['showFloorPlans'] = $site->name === 'Siege';
    }

    return view('superadmin.sites', $data);
}
public function show(Site $site, $branchType = null)
{
    $data = [
        'site' => $site,
        'branchType' => $branchType
    ];

    // Special handling for Siege
    if ($site->name === 'Siege') {
        if ($branchType === 'carburant') {
            $data['showFloorPlans'] = true;
        } elseif ($branchType === 'agence') {
            $data['showAgencePlan'] = true;
        }
    }

    return view('superadmin.sites', $data);
}

public function showBranche(Site $site, $branchType)
{
    $branche = $site->branches()
                    ->where('name', $branchType)
                    ->whereNull('parent_id')
                    ->with('children')
                    ->firstOrFail();

    return view('superadmin.sites', [
        'site' => $site,
        'branchType' => $branchType,
        'branche' => $branche
    ]);
}

public function showBrancheDetail(Site $site, $branchType, Branche $branch)
{
    // Vérifier que la branche appartient bien au site
    if ($branch->site_id !== $site->id) {
        abort(404);
    }

    return view('superadmin.sites', [
        'site' => $site,
        'branchType' => $branchType,
        'branch' => $branch,
        'showAgencePlan' => $branchType === 'agence' && $site->name === 'Siege',
        'showFloorPlans' => $branchType === 'carburant' && $site->name === 'Siege'
    ]);
}

}
