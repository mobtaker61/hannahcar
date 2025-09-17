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
        Schema::table('vehicle_variants', function (Blueprint $table) {
            $table->foreign('model_id')->references('id')->on('vehicle_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_variants', function (Blueprint $table) {
            $table->dropForeign(['model_id']);
        });
    }
};
