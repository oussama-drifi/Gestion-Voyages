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
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum("statut", ["validé", "annulé"])->default("validé")->after("prix");
            $table->unique(["voyage_id", "numero_place"], "unique_seat_per_voyage");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropUnique("unique_seat_per_voyage");
            $table->dropColumn("statut");
        });
    }
};
