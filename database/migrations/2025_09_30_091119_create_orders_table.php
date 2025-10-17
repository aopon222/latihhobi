<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id_order');
            $table->unsignedBigInteger('id_user');
            $table->unsignedInteger('id_coupon')->nullable();
            $table->string('coupon_code', 50)->nullable();
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->dateTime('order_date')->useCurrent();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_coupon')->references('id_coupon')->on('coupon')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};