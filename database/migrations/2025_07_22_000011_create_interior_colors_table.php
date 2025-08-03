<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interior_colors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Beige, Black, Grey, Brown, White, Red, Blue, Green
            $table->string('slug')->unique();
            $table->string('hex_code')->nullable(); // #F5F5DC, #000000, etc.
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interior_colors');
    }
};
