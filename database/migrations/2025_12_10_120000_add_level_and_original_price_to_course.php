<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course', function (Blueprint $table) {
            if (!Schema::hasColumn('course', 'original_price')) {
                $table->decimal('original_price', 10, 2)->nullable()->after('price');
            }

            if (!Schema::hasColumn('course', 'level')) {
                $table->string('level', 50)->nullable()->after('original_price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('course', function (Blueprint $table) {
            if (Schema::hasColumn('course', 'original_price')) {
                $table->dropColumn('original_price');
            }

            if (Schema::hasColumn('course', 'level')) {
                $table->dropColumn('level');
            }
        });
    }
};
