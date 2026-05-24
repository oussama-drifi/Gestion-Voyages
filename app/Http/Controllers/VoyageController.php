<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use App\Models\Voyage;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    public function index()
    {
        $voyages = Voyage::with(['agenceDepart', 'agenceArrive', 'bus'])->get();
        return view('voyages.index', compact('voyages'));
    }

    public function show(Voyage $voyage)
    {
        $voyage->load(['agenceDepart', 'agenceArrive', 'bus.societe', 'voyagePrincipale', 'sousVoyages']);
        return view('voyages.show', compact('voyage'));
    }

    public function create(Societe $societe)
    {
        $societe->load(['agences', 'buses']);

        // Only main voyages of this société's buses as parent candidates
        $parentVoyages = Voyage::whereNull('voyage_principale_id')
            ->whereHas('bus', fn($q) => $q->where('societe_id', $societe->societe_id))
            ->orderBy('date')->orderBy('heure_depart')
            ->get();

        return view('voyages.create', compact('societe', 'parentVoyages'));
    }

    public function store(Request $request, Societe $societe)
    {
        $data = $request->validate([
            'ville_depart'         => 'required|string|max:255',
            'ville_arrive'         => 'required|string|max:255',
            'heure_depart'         => 'required|date_format:H:i',
            'heure_arrive'         => 'required|date_format:H:i',
            'date'                 => 'required|date',
            'agence_depart_id'     => 'required|exists:agences,agence_id',
            'agence_arrive_id'     => 'required|exists:agences,agence_id',
            'bus_id'               => 'required|exists:buses,bus_id',
            'prix'                 => 'required|numeric|min:0',
            'voyage_principale_id' => 'nullable|exists:voyages,voyage_id',
        ]);

        // Ensure agences and bus belong to this société
        abort_unless(
            $societe->agences->contains('agence_id', $data['agence_depart_id']) &&
            $societe->agences->contains('agence_id', $data['agence_arrive_id']) &&
            $societe->buses->contains('bus_id', $data['bus_id']),
            403
        );

        Voyage::create($data);

        return redirect()->route('societes.show', $societe)
            ->with('success', 'Voyage créé avec succès.');
    }
}
