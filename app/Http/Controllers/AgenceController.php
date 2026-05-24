<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\Societe;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    public function index()
    {
        $agences = Agence::with('societe')->get();
        return view('agences.index', compact('agences'));
    }

    public function show(Agence $agence)
    {
        return view('agences.show', compact('agence'));
    }

    public function create()
    {
        $societes = Societe::orderBy('nom')->get();
        return view('agences.create', compact('societes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'        => 'required|string|max:255',
            'adresse'    => 'required|string|max:255',
            'ville'      => 'required|string|max:255',
            'societe_id' => 'required|exists:societes,societe_id',
        ]);

        Agence::create($data);

        return redirect()->route('agences.index')
            ->with('success', 'Agence créée avec succès.');
    }
}
