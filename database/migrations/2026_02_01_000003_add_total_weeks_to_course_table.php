<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('course', function (Blueprint $table) {
            $table->integer('total_weeks')->default(4)->after('level');
        });
    }

    public function down()
    {
        Schema::table('course', function (Blueprint $table) {
            $table->dropColumn('total_weeks');
        });
    }
};
