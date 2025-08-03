<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            // Basic Information
            $table->foreignId('brand_id')->constrained('vehicle_brands')->onDelete('cascade');
            $table->foreignId('model_id')->constrained('vehicle_models')->onDelete('cascade');
            $table->integer('year');
            $table->decimal('price', 15, 2);
            $table->string('currency', 3)->default('AED'); // AED, USD, EUR, IRR
            $table->integer('mileage')->nullable(); // in kilometers
            $table->text('description')->nullable();

            // Status and Visibility
            $table->enum('status', ['new', 'used', 'export'])->default('new');
            $table->enum('publish_status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_available')->default(true);

            // Regional and Body Specifications
            $table->foreignId('regional_spec_id')->nullable()->constrained('regional_specs')->onDelete('set null');
            $table->foreignId('body_type_id')->nullable()->constrained('body_types')->onDelete('set null');
            $table->foreignId('seats_count_id')->nullable()->constrained('seats_counts')->onDelete('set null');

            // Engine and Performance
            $table->foreignId('fuel_type_id')->nullable()->constrained('fuel_types')->onDelete('set null');
            $table->foreignId('transmission_type_id')->nullable()->constrained('transmission_types')->onDelete('set null');
            $table->foreignId('engine_capacity_range_id')->nullable()->constrained('engine_capacity_ranges')->onDelete('set null');
            $table->foreignId('horsepower_range_id')->nullable()->constrained('horsepower_ranges')->onDelete('set null');
            $table->foreignId('cylinders_count_id')->nullable()->constrained('cylinders_counts')->onDelete('set null');
            $table->foreignId('steering_side_id')->nullable()->constrained('steering_sides')->onDelete('set null');

            // Colors
            $table->foreignId('exterior_color_id')->nullable()->constrained('exterior_colors')->onDelete('set null');
            $table->foreignId('interior_color_id')->nullable()->constrained('interior_colors')->onDelete('set null');

            // Additional Information
            $table->string('vin_number')->nullable()->unique();
            $table->json('features')->nullable(); // Array of features/options
            $table->string('featured_image')->nullable();
            $table->integer('views_count')->default(0);

            // User and Timestamps
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index(['publish_status', 'published_at']);
            $table->index(['is_featured', 'published_at']);
            $table->index(['brand_id', 'model_id']);
            $table->index(['status', 'publish_status']);
            $table->index(['price', 'currency']);
            $table->index(['year']);
            $table->index(['mileage']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
