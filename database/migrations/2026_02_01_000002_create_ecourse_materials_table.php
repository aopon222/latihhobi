<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ecourse_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('week_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['video', 'pdf', 'link', 'file']);
            $table->string('video_url')->nullable(); // YouTube embed URL
            $table->string('file_path')->nullable(); // Path to uploaded file
            $table->string('file_name')->nullable(); // Original file name
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('week_id')->references('id')->on('ecourse_weeks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ecourse_materials');
    }
};
