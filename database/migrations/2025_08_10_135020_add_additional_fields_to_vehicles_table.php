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
        Schema::table('vehicles', function (Blueprint $table) {
            // Additional vehicle flags
            $table->boolean('is_negotiable')->default(false)->after('is_available');
            $table->boolean('is_imported')->default(false)->after('is_negotiable');

            // Additional vehicle information
            $table->date('purchase_date')->nullable()->after('features');
            $table->date('warranty_expiry')->nullable()->after('purchase_date');
            $table->date('insurance_expiry')->nullable()->after('warranty_expiry');
            $table->string('registration_number')->nullable()->after('insurance_expiry');
            $table->string('engine_number')->nullable()->after('registration_number');
            $table->string('chassis_number')->nullable()->after('engine_number');
            $table->enum('doors_count', ['2', '3', '4', '5'])->nullable()->after('chassis_number');
            $table->enum('air_conditioning', ['manual', 'automatic', 'dual_zone', 'none'])->nullable()->after('doors_count');

            // Location information
            $table->string('location_city')->nullable()->after('air_conditioning');
            $table->string('location_country')->nullable()->after('location_city');

            // SEO and meta information
            $table->string('meta_title')->nullable()->after('location_country');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');

            // Priority and ordering
            $table->integer('priority_order')->default(0)->after('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'is_negotiable',
                'is_imported',
                'purchase_date',
                'warranty_expiry',
                'insurance_expiry',
                'registration_number',
                'engine_number',
                'chassis_number',
                'doors_count',
                'air_conditioning',
                'location_city',
                'location_country',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'priority_order'
            ]);
        });
    }
};
