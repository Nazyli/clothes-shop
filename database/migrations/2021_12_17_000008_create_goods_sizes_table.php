<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goods_color_id');
            $table->foreign('goods_color_id')->references('id')->on('goods_colors');
            $table->string("size");
            $table->float("additional_price", 12, 2);
            $table->integer("qty");
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
        Schema::dropIfExists('goods_sizes');
    }
}
