<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Voyage;
use Illuminate\Http\Request;

class ClientVoyageController extends Controller
{
    public function index(Request $request)
    {
        $query = Voyage::with(['bus.societe', 'agenceDepart', 'agenceArrive']);

        if ($request->filled('ville_depart')) {
            $query->where('ville_depart', 'like', '%' . $request->ville_depart . '%');
        }
        if ($request->filled('ville_arrive')) {
            $query->where('ville_arrive', 'like', '%' . $request->ville_arrive . '%');
        }
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        $voyages = $query->orderBy('date')->orderBy('heure_depart')->get();

        return view('client.voyages.index', compact('voyages'));
    }

    public function show(Voyage $voyage)
    {
        $voyage->load(['bus.societe', 'agenceDepart', 'agenceArrive', 'tickets']);

        // Build timeline: find root voyage then list stops
        $root = $voyage;
        while ($root->voyage_principale_id) {
            $root = Voyage::find($root->voyage_principale_id);
        }

        // Timeline stops: root node + each sub-voyage ordered by heure_depart
        $stops = collect();
        $stops->push(['ville' => $root->ville_depart, 'heure' => $root->heure_depart, 'is_highlight' => false]);

        $subs = Voyage::where('voyage_principale_id', $root->voyage_id)
            ->orderBy('heure_depart')
            ->get();

        foreach ($subs as $sub) {
            $stops->push([
                'ville' => $sub->ville_arrive,
                'heure' => $sub->heure_arrive,
                'is_highlight' => $sub->voyage_id === $voyage->voyage_id,
            ]);
        }

        // If viewing the root itself, highlight its own depart and last arrive
        if ($voyage->voyage_id === $root->voyage_id) {
            $stops = $stops->map(function ($stop, $i) use ($stops) {
                $stop['is_highlight'] = ($i === 0 || $i === $stops->count() - 1);
                return $stop;
            });
        } else {
            // Highlight the depart stop of the current sub-voyage too
            $stops = $stops->map(function ($stop) use ($voyage) {
                if ($stop['ville'] === $voyage->ville_depart) {
                    $stop['is_highlight'] = true;
                }
                return $stop;
            });
        }

        // Booked seat numbers for this voyage
        $bookedSeats = $voyage->tickets->pluck('numero_place')->toArray();

        return view('client.voyages.show', compact('voyage', 'stops', 'bookedSeats', 'root'));
    }
}
