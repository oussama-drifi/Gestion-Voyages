<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('buses')
            ->where('comfort', 'normale')
            ->update(['comfort' => 'bon']);

        DB::statement("ALTER TABLE buses MODIFY comfort ENUM('basique', 'bon', 'comfortable') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('buses')
            ->where('comfort', 'bon')
            ->update(['comfort' => 'normale']);

        DB::statement("ALTER TABLE buses MODIFY comfort ENUM('basique', 'normale', 'comfortable') NOT NULL");
    }
};