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
        Schema::rename('vehicle_types', 'vehicle_variants');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('vehicle_variants', 'vehicle_types');
    }
};
