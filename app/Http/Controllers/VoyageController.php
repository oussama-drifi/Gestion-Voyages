<?php

namespace App\Http\Controllers;

use App\Models\Voyage;

class VoyageController extends Controller
{
    public function index()
    {
        $voyages = Voyage::with(['agenceDepart', 'agenceArrive', 'bus'])->get();
        return view('voyages.index', compact('voyages'));
    }

    public function show(Voyage $voyage)
    {
        $voyage->load(['agenceDepart', 'agenceArrive', 'bus', 'voyagePrincipale', 'sousVoyages']);
        return view('voyages.show', compact('voyage'));
    }
}
