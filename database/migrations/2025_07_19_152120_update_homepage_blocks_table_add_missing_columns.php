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
        Schema::table('homepage_blocks', function (Blueprint $table) {
            $table->string('type')->after('id'); // featured, service, testimonial, news, stats
            $table->string('image')->nullable()->after('type');
            $table->string('button_url')->nullable()->after('image');
            $table->string('icon')->nullable()->after('button_url');
            $table->string('background_color')->default('#F3F4F6')->after('icon');

            // Remove the old name column if it exists
            if (Schema::hasColumn('homepage_blocks', 'name')) {
                $table->dropColumn('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homepage_blocks', function (Blueprint $table) {
            $table->string('name')->unique();
            $table->dropColumn(['type', 'image', 'button_url', 'icon', 'background_color']);
        });
    }
};
