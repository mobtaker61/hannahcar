<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiry_special_car_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('phone');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('car_brand')->nullable();
            $table->string('car_model')->nullable();
            $table->integer('car_year')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['new', 'in_progress', 'done', 'rejected'])->default('new');
            $table->timestamps();
            $table->index('phone');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('inquiry_special_car_purchases');
    }
};
