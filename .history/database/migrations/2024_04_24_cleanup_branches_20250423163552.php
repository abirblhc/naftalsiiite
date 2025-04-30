<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CleanupBranches extends Migration
{
    public function up()
    {
        // Supprimer les doublons sans détails
        DB::table('branches')
            ->whereNull('details')
            ->delete();
    }

    public function down()
    {
        // Cette migration ne peut pas être annulée car elle supprime des données en double
    }
}
