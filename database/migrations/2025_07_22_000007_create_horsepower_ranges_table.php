<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horsepower_ranges', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 0-99hp, 100-199hp, 200-299hp, 300-399hp, 400-499hp, 500hp+
            $table->integer('min_horsepower')->nullable(); // 0, 100, 200, 300, 400, 500
            $table->integer('max_horsepower')->nullable(); // 99, 199, 299, 399, 499, null
            $table->string('display_name'); // Under 100hp, 100-200hp, 200-300hp, 300-400hp, 400-500hp, 500hp+
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horsepower_ranges');
    }
};
