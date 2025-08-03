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
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'default_value')) {
                $table->text('default_value')->nullable()->after('type');
            }
            if (!Schema::hasColumn('settings', 'options')) {
                $table->text('options')->nullable()->after('default_value');
            }
            if (!Schema::hasColumn('settings', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('options');
            }
            if (!Schema::hasColumn('settings', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['default_value', 'options', 'is_active', 'sort_order']);
        });
    }
};
