<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // First, we need to drop the existing enum and recreate it
            $table->enum('status', ['new', 'used', 'export'])->default('new')->change();
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Revert back to original enum
            $table->enum('status', ['new', 'used'])->default('new')->change();
        });
    }
};
