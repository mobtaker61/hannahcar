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
        Schema::table('setting_translations', function (Blueprint $table) {
            if (!Schema::hasColumn('setting_translations', 'label')) {
                $table->string('label')->after('language_id');
            }
            if (!Schema::hasColumn('setting_translations', 'value')) {
                $table->text('value')->nullable()->after('label');
            }
            if (!Schema::hasColumn('setting_translations', 'description')) {
                $table->text('description')->nullable()->after('value');
            }
            if (!Schema::hasColumn('setting_translations', 'help_text')) {
                $table->string('help_text')->nullable()->after('description');
            }
            if (!Schema::hasColumn('setting_translations', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('help_text');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_translations', function (Blueprint $table) {
            $table->dropColumn(['label', 'value', 'description', 'help_text', 'is_active']);
        });
    }
};
