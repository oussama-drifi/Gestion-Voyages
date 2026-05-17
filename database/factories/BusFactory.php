<?php

namespace Database\Factories;

use App\Models\Bus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Societe;

/**
 * @extends Factory<Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'modele'        => $this->faker->randomElement(['Mercedes Tourismo', 'Volvo 9700', 'Scania Irizar', 'MAN Lion\'s Coach', 'Setra S 516']),
            'comfort'       => $this->faker->randomElement(['basique', 'bon', 'comfortable']),
            'wifi'          => $this->faker->boolean(60),
            'totale_places' => $this->faker->randomElement([35, 40, 45, 50]),
            'societe_id'    => Societe::inRandomOrder()->value('societe_id'),
        ];
    }
}
