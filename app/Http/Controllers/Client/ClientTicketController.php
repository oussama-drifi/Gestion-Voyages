<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Voyage;
use Illuminate\Http\Request;

class ClientTicketController extends Controller
{
    public function store(Request $request, Voyage $voyage)
    {
        $request->validate([
            'numero_place' => 'required|integer|min:1|max:' . $voyage->bus->totale_places,
        ]);

        // Check seat not already taken
        $taken = Ticket::where('voyage_id', $voyage->voyage_id)
            ->where('numero_place', $request->numero_place)
            ->exists();

        if ($taken) {
            return back()->withErrors(['numero_place' => 'Cette place est déjà réservée.']);
        }

        Ticket::create([
            'numero_place' => $request->numero_place,
            'prix'         => $voyage->prix,
            'statut'       => 'validé',
            'user_id'      => auth()->id(),
            'voyage_id'    => $voyage->voyage_id,
        ]);

        return redirect()->route('client.tickets.index')
            ->with('success', 'Réservation confirmée ! Place ' . $request->numero_place . ' sur ' . $voyage->ville_depart . ' → ' . $voyage->ville_arrive . '.');
    }

    public function index()
    {
        $tickets = Ticket::with(['voyage.bus.societe', 'voyage.agenceDepart', 'voyage.agenceArrive'])
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        return view('client.tickets.index', compact('tickets'));
    }
}
