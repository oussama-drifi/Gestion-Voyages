<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->id("voyage_id");
            $table->string("ville_depart");
            $table->string("ville_arrive");
            $table->time("heure_depart");
            $table->time("heure_arrive");
            $table->date("date");
            $table->foreignId("agence_depart_id")->constrained("agences", "agence_id")->onDelete("cascade");
            $table->foreignId("agence_arrive_id")->constrained("agences", "agence_id")->onDelete("cascade");
            $table->foreignId("voyage_principale_id")->nullable()->constrained("voyages", "voyage_id")->onDelete("cascade");
            $table->foreignId("bus_id")->constrained("buses", "bus_id")->onDelete("cascade");
            $table->integer("nombre_passagers");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
