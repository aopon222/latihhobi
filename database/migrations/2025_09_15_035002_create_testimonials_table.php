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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // yang memberikan testimoni
            $table->foreignId('program_id')->nullable()->constrained();
            $table->foreignId('class_id')->nullable()->constrained();
            $table->string('name'); // nama yang ditampilkan
            $table->string('role')->nullable(); // misal: Orang tua siswa, Siswa
            $table->text('content');
            $table->integer('rating')->default(5); // 1-5
            $table->string('avatar')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->date('testimonial_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
