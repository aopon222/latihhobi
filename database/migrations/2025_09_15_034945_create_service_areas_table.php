<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        // Create the service_areas table if it doesn't exist yet
        if (!Schema::hasTable('service_areas')) {
            Schema::create('service_areas', function (Blueprint $table) {
                $table->id();
                $table->string('kota');
                $table->string('provinsi');
                $table->json('kecamatan')->nullable();
                $table->boolean('is_priority')->default(false);
                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('service_areas');
    }
};