<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Societe;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::with('societe')->get();
        return view('buses.index', compact('buses'));
    }

    public function show(Bus $bus)
    {
        return view('buses.show', compact('bus'));
    }

    public function create()
    {
        $societes = Societe::orderBy('nom')->get();
        return view('buses.create', compact('societes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'modele'        => 'required|string|max:255',
            'comfort'       => 'required|in:basique,bon,comfortable',
            'wifi'          => 'boolean',
            'totale_places' => 'required|integer|min:1',
            'societe_id'    => 'required|exists:societes,societe_id',
        ]);

        $data['wifi'] = $request->boolean('wifi');

        Bus::create($data);

        return redirect()->route('buses.index')
            ->with('success', 'Bus créé avec succès.');
    }
}
