<?php

namespace Database\Factories;

use App\Models\Agence;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Societe;

/**
 * @extends Factory<Agence>
 */
class AgenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $villes = ['Casablanca', 'Rabat', 'Marrakech', 'Fès', 'Meknès', 'Tanger', 'Agadir', 'Oujda', 'Kénitra', 'Tétouan'];
        $agences = ['maarif', 'al wifak', 'hay salam', 'borgogne', 'boukhalef', 'mehdia', 'hay mly abdellah', 'avenue taddart'];

        return [
            'nom'        => 'Agence '.$this->faker->randomElement($agences),
            'adresse'    => $this->faker->streetAddress(),
            'ville'      => $this->faker->randomElement($villes),
            'societe_id' => Societe::inRandomOrder()->value('societe_id'),
        ];
    }
}
