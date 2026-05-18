<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id("ticket_id");
            $table->integer("numero_place");
            $table->decimal("prix", 6, 2);
            $table->foreignId("user_id")->constrained("users", "user_id")->onDelete("cascade");
            $table->foreignId("voyage_id")->constrained("voyages", "voyage_id")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
