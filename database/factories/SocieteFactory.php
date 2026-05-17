<?php

namespace Database\Factories;

use App\Models\Societe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Societe>
 */
class SocieteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $societes = [
            ['nom' => 'CTM', 'adresse_siege' => 'Rue Léon l\'Africain, Casablanca'],
            ['nom' => 'Supratours', 'adresse_siege' => 'Avenue Hassan II, Rabat'],
            ['nom' => 'Ghazala Bus', 'adresse_siege' => 'Boulevard Mohammed V, Marrakech'],
            ['nom' => 'Trans Gharb', 'adresse_siege' => 'Avenue Mohammed VI, Kénitra'],
            ['nom' => 'Pullman du Maroc', 'adresse_siege' => 'Rue de Fès, Meknès'],
        ];

        $entry = $this->faker->unique()->randomElement($societes);

        return [
            'nom' => $entry['nom'],
            'adresse_siege' => $entry['adresse_siege'],
        ];
    }
}