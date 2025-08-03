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
        Schema::table('homepage_block_translations', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('title');
            $table->text('description')->nullable()->after('subtitle');
            $table->string('button_text')->nullable()->after('description');
            $table->json('meta_data')->nullable()->after('button_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homepage_block_translations', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'description', 'button_text', 'meta_data']);
        });
    }
};
