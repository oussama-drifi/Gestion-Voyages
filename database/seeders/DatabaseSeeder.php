<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Societe;
use App\Models\Bus;
use App\Models\Agence;
use App\Models\Ticket;
use App\Models\Voyage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // users
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@travel.ma',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        User::factory(10)->create([
            'role' => 'client',
        ]);

        // sociétés
        Societe::factory(5)->create();

        // agences (3 par societe)
        Societe::all()->each(function ($societe) {
            Agence::factory(3)->create(['societe_id' => $societe->societe_id]);
        });

        // buses (4 par société)
        Societe::all()->each(function ($societe) {
            Bus::factory(4)->create(['societe_id' => $societe->societe_id]);
        });
    }
}
