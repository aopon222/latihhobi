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
        Schema::create('ecourse_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ecourse_enrollment_id')->constrained()->onDelete('cascade');
            $table->foreignId('ecourse_lesson_id')->constrained('ecourse_lessons')->onDelete('cascade');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('watched_duration')->default(0); // in seconds
            $table->integer('total_duration')->default(0); // in seconds
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecourse_progress');
    }
};
