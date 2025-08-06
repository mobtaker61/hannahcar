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
        Schema::table('inquiry_special_car_purchases', function (Blueprint $table) {
            $table->foreignId('car_brand_id')->nullable()->constrained('vehicle_brands')->onDelete('set null')->after('car_brand');
            $table->foreignId('car_model_id')->nullable()->constrained('vehicle_models')->onDelete('set null')->after('car_model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiry_special_car_purchases', function (Blueprint $table) {
            $table->dropForeign(['car_brand_id']);
            $table->dropForeign(['car_model_id']);
            $table->dropColumn(['car_brand_id', 'car_model_id']);
        });
    }
};
