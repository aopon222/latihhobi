<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('enrollment_number')->unique(); // nomor pendaftaran otomatis
            $table->foreignId('student_id')->constrained('users');
            $table->foreignId('class_id')->constrained();
            $table->foreignId('parent_id')->nullable()->constrained('users');
            $table->decimal('original_price', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('final_price', 12, 2);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->enum('payment_status', ['pending', 'partial', 'paid', 'refunded', 'cancelled'])->default('pending');
            $table->enum('status', ['pending', 'active', 'inactive', 'completed', 'dropped', 'cancelled'])->default('pending');
            $table->date('enrolled_at');
            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->text('parent_notes')->nullable();
            $table->json('emergency_contact')->nullable();
            $table->json('special_needs')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
