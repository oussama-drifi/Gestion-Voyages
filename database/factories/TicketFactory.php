<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Voyage;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // database/factories/TicketFactory.php

    public function definition(): array
    {
        $voyage = Voyage::inRandomOrder()->first();

        // Trouver un numéro de place libre pour ce voyage
        $placesOccupees = Ticket::where('voyage_id', $voyage->voyage_id)->pluck('numero_place')->toArray();
        $toutesLesPlaces = range(1, $voyage->bus->totale_places);
        $placesLibres = array_diff($toutesLesPlaces, $placesOccupees);

        // Si plus de places libres on skip (le seeder gère ça)
        $numeroPlace = !empty($placesLibres) ? $this->faker->randomElement($placesLibres) : 1;

        return [
            'numero_place' => $numeroPlace,
            'prix'         => $this->faker->randomElement([80, 100, 120, 150, 180, 200, 220, 250]),
            'statut'       => 'actif',
            'user_id'      => User::where('role', 'client')->inRandomOrder()->value('id'),
            'voyage_id'    => $voyage->voyage_id,
        ];
    }
}
