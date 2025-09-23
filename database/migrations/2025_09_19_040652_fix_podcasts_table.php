<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the duplicate migration
        Schema::dropIfExists('podcasts');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't need to reverse this
    }
};
