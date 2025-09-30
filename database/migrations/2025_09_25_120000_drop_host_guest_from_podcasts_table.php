<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('podcasts', function (Blueprint $table) {
            if (Schema::hasColumn('podcasts', 'host')) {
                $table->dropColumn('host');
            }

            if (Schema::hasColumn('podcasts', 'guest')) {
                $table->dropColumn('guest');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('podcasts', function (Blueprint $table) {
            if (! Schema::hasColumn('podcasts', 'host')) {
                $table->string('host')->nullable()->after('title');
            }

            if (! Schema::hasColumn('podcasts', 'guest')) {
                $table->string('guest')->nullable()->after('host');
            }
        });
    }
};
