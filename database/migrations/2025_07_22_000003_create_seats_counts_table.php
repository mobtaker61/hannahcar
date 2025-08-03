<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seats_counts', function (Blueprint $table) {
            $table->id();
            $table->integer('count'); // 2, 4, 5, 7, 8, 9
            $table->string('name')->nullable(); // Two Seater, Four Seater, etc.
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seats_counts');
    }
};
