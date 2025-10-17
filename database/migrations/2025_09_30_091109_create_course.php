<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id_course');
            $table->unsignedInteger('id_category');
            $table->string('name', 255);
            $table->string('course_by', 255)->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image_url', 255)->nullable(); // kolom untuk menyimpan URL gambar
            $table->timestamps();

            $table->foreign('id_category')
                  ->references('id_category')
                  ->on('category')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
