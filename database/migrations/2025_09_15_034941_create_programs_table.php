<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->enum('type', ['ekskul_reguler', 'private_class', 'bootcamp', 'workshop']);
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('discount_price', 12, 2)->nullable();
            $table->string('duration');
            $table->integer('total_sessions')->nullable();
            $table->integer('max_students')->nullable();
            $table->integer('min_students')->default(1);
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->string('difficulty_level')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('curriculum')->nullable();
            $table->json('requirements')->nullable();
            $table->json('benefits')->nullable();
            $table->json('tools_needed')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
