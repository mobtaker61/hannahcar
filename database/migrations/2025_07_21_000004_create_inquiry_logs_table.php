<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiry_logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('inquiryable'); // inquiryable_id, inquiryable_type
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // کارمند ثبت کننده
            $table->text('action')->nullable(); // توضیح یا نوع اقدام
            $table->enum('status', ['new', 'in_progress', 'done', 'rejected'])->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('inquiry_logs');
    }
};
