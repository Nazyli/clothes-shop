<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orders_id');
            $table->foreign('orders_id')->references('id')->on('orders');
            $table->unsignedBigInteger('goods_id');
            $table->foreign('goods_id')->references('id')->on('goods');
            $table->string('goods_name');
            $table->string('color');
            $table->float('additional_color_price', 12, 2);
            $table->string('size');
            $table->float('additional_size_price', 12, 2);
            $table->integer('qty');
            $table->float('total_price', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_details');
    }
}
