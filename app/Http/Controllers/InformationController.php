<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function informations()
    {
        return view('informations'); // on va créer cette vue
    }
}
