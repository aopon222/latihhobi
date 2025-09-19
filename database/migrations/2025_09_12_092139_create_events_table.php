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
        if (!Schema::hasTable('events')) {
            Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description');
                $table->text('short_description')->nullable();
                $table->string('type')->nullable(); // workshop, bootcamp, holiday class
                $table->timestamp('start_date')->nullable();
                $table->timestamp('end_date')->nullable();
                $table->timestamp('registration_start')->nullable();
                $table->timestamp('registration_end')->nullable();
                $table->string('location')->nullable();
                $table->text('location_details')->nullable();
                $table->integer('max_participants')->default(0);
                $table->integer('current_participants')->default(0);
                $table->decimal('price', 12, 2)->default(0);
                $table->string('image')->nullable();
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_active')->default(true);
                $table->string('status')->default('draft'); // draft, open, full, ongoing, completed, cancelled
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
