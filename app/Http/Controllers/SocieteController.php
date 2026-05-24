<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use Illuminate\Http\Request;

class SocieteController extends Controller
{
    public function index()
    {
        $societes = Societe::withCount(['agences', 'buses'])->get();
        return view('societes.index', compact('societes'));
    }

    public function show(Societe $societe)
    {
        return view('societes.show', compact('societe'));
    }

    public function create()
    {
        return view('societes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'           => 'required|string|max:255',
            'adresse_siege' => 'required|string|max:255',
        ]);

        Societe::create($data);

        return redirect()->route('societes.index')
            ->with('success', 'Société créée avec succès.');
    }
}
