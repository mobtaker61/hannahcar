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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Original file name
            $table->string('filename'); // Stored file name
            $table->string('path'); // File path
            $table->string('mime_type'); // File MIME type
            $table->integer('size'); // File size in bytes
            $table->string('disk')->default('public'); // Storage disk
            $table->string('type')->nullable(); // File type (logo, favicon, etc.)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
