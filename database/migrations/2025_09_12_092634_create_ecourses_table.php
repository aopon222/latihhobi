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
        Schema::create('ecourses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('category')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('discount_price', 12, 2)->nullable();
            $table->string('duration')->nullable(); // e.g., "4 weeks"
            $table->integer('total_lessons')->default(0);
            $table->string('level')->nullable(); // beginner, intermediate, advanced
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('demo_video')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->json('prerequisites')->nullable();
            $table->json('learning_outcomes')->nullable();
            $table->json('tools_needed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecourses');
    }
};
