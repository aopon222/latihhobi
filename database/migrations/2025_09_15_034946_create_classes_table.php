<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('classes')) {
            Schema::create('classes', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->foreignId('program_id')->constrained()->onDelete('cascade');
                $table->foreignId('tutor_id')->constrained('users');
                $table->foreignId('school_id')->nullable()->constrained();
                $table->foreignId('service_area_id')->nullable()->constrained();
                $table->string('name');
                $table->text('description')->nullable();
                $table->enum('type', ['online', 'offline', 'hybrid']);
                $table->integer('max_students');
                $table->integer('current_students')->default(0);
                $table->decimal('price', 12, 2); // bisa berbeda dengan program price
                $table->date('registration_start');
                $table->date('registration_end');
                $table->date('start_date');
                $table->date('end_date')->nullable();
                $table->json('schedule'); // JSON untuk jadwal detail
                $table->string('location')->nullable();
                $table->text('location_details')->nullable();
                $table->string('meeting_link')->nullable(); // untuk online class
                $table->string('meeting_password')->nullable();
                $table->enum('status', ['draft', 'open', 'full', 'ongoing', 'completed', 'cancelled'])->default('draft');
                $table->text('notes')->nullable();
                $table->json('materials')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
