<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cylinders_counts', function (Blueprint $table) {
            $table->id();
            $table->integer('count'); // 3, 4, 5, 6, 8, 10, 12, 16
            $table->string('name')->nullable(); // 3-Cylinder, 4-Cylinder, etc.
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cylinders_counts');
    }
};
