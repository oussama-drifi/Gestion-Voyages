<?php

namespace Database\Factories;

use App\Models\Voyage;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Agence;
use App\Models\Bus;

/**
 * @extends Factory<Voyage>
 */
class VoyageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $villes = ['Casablanca', 'Rabat', 'Marrakech', 'Fès', 'Meknès', 'Tanger', 'Agadir', 'Oujda', 'Kénitra', 'Tétouan'];

        $villeDepart = $this->faker->randomElement($villes);
        $villeArrive = $this->faker->randomElement(array_diff($villes, [$villeDepart]));

        $heureDepart = $this->faker->randomElement(['06:00', '08:00', '09:30', '11:00', '13:00', '15:30', '17:00', '19:00', '21:00', '23:00']);
        $heureArrive = $this->faker->randomElement(['09:00', '11:00', '12:30', '14:00', '17:00', '19:30', '21:00', '23:00', '02:00', '04:00']);

        return [
            'ville_depart'         => $villeDepart,
            'ville_arrive'         => $villeArrive,
            'heure_depart'         => $heureDepart,
            'heure_arrive'         => $heureArrive,
            'date'                 => $this->faker->dateTimeBetween('now', '+3 months')->format('Y-m-d'),
            'agence_depart_id'     => Agence::inRandomOrder()->value('agence_id'),
            'agence_arrive_id'     => Agence::inRandomOrder()->value('agence_id'),
            'voyage_principale_id' => null,
            'bus_id'               => Bus::inRandomOrder()->value('bus_id'),
        ];
    }
}
