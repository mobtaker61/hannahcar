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
        Schema::create('inquiry_forms', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // شناسه یکتا برای فرم
            $table->string('name'); // نام فرم
            $table->string('title'); // عنوان نمایشی
            $table->text('description')->nullable(); // توضیحات فرم
            $table->string('route_name'); // نام route فرم
            $table->string('controller'); // نام کنترلر
            $table->string('model'); // نام مدل
            $table->string('icon')->nullable(); // آیکون فرم
            $table->string('color')->default('blue'); // رنگ فرم
            $table->boolean('is_active')->default(true); // فعال/غیرفعال
            $table->integer('sort_order')->default(0); // ترتیب نمایش
            $table->json('fields')->nullable(); // فیلدهای فرم (JSON)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry_forms');
    }
};
