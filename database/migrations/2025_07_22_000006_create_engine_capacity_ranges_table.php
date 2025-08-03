<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('engine_capacity_ranges', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 0-999cc, 1000-1499cc, 1500-1999cc, 2000-2499cc, 2500cc+
            $table->integer('min_capacity')->nullable(); // 0, 1000, 1500, 2000, 2500
            $table->integer('max_capacity')->nullable(); // 999, 1499, 1999, 2499, null
            $table->string('display_name'); // 1.0L, 1.5L, 2.0L, 2.5L+
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('engine_capacity_ranges');
    }
};
