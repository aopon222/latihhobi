<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->unique();
            $table->foreignId('enrollment_id')->constrained();
            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['bank_transfer']);
            $table->string('transaction_id')->nullable();
            $table->string('reference_number')->nullable();
            $table->json('gateway_response')->nullable();
            $table->enum('status', ['pending', 'processing', 'success', 'failed', 'cancelled', 'expired'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->text('notes')->nullable();
            $table->json('proof_images')->nullable(); // untuk bank transfer
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
