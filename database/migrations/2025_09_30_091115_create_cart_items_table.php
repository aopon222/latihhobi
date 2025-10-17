<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id_cart_items');
            $table->unsignedInteger('id_cart');
            $table->unsignedInteger('id_course');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->decimal('sub_total', 10, 2);
            $table->timestamps();

            $table->foreign('id_cart')->references('id_cart')->on('cart')->onDelete('cascade');
            $table->foreign('id_course')->references('id_course')->on('course_card')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};