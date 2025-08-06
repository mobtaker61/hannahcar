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
            $table->string('delivery_location')->nullable()->after('car_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiry_special_car_purchases', function (Blueprint $table) {
            $table->dropColumn('delivery_location');
        });
    }
};
