<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ecourse_weeks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ecourse_id');
            $table->integer('week_number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('ecourse_id')->references('id_course')->on('course')->onDelete('cascade');
            $table->unique(['ecourse_id', 'week_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ecourse_weeks');
    }
};
