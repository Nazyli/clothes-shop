<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goods_id');
            $table->foreign('goods_id')->references('id')->on('goods');
            $table->string("color");
            $table->float("additional_price", 12, 2);
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
        Schema::dropIfExists('goods_colors');
    }
}
