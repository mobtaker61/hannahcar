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
        Schema::table('vehicle_brands', function (Blueprint $table) {
            $table->boolean('models_completed')->default(false)->after('sort_order');
            $table->timestamp('models_updated_at')->nullable()->after('models_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_brands', function (Blueprint $table) {
            $table->dropColumn(['models_completed', 'models_updated_at']);
        });
    }
};
