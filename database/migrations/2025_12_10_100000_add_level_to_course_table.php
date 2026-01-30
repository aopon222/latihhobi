<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('course', 'level')) {
            Schema::table('course', function (Blueprint $table) {
                $table->string('level', 50)->nullable()->after('image_url');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('course', 'level')) {
            Schema::table('course', function (Blueprint $table) {
                $table->dropColumn('level');
            });
        }
    }
};
