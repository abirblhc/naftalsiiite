<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branche;
use App\Models\Site;

class BranchesTableSeeder extends Seeder
{
    public function run()
    {
        // Créer des sites de test si nécessaire
        $sites = Site::all();

        if ($sites->isEmpty()) {
            $sites = collect([
                Site::create(['name' => 'Site 1']),
                Site::create(['name' => 'Site 2']),
                Site::create(['name' => 'Site 3']),
                Site::create(['name' => 'Site 4'])
            ]);
        }

        // Pour chaque site, créer une branche carburant
        foreach ($sites as $site) {
            Branche::create([
                'site_id' => $site->id,
                'name' => 'carburant',
                'details' => null
            ]);
        }

        // Pour chaque site, créer une branche commercial avec des détails
        foreach ($sites as $site) {
            Branche::create([
                'site_id' => $site->id,
                'name' => 'commercial',
                'details' => json_encode([
                    'agence' => 'Agence ' . $site->name,
                    'LP' => 'LP ' . $site->name,
                    'CDD' => 'CDD ' . $site->name,
                    'GD' => 'GD ' . $site->name
                ])
            ]);
        }
    }
}
