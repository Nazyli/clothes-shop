<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string("goods_name");
            $table->text("description");
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('master_categories');
            $table->boolean("is_active");
            $table->float("base_price", 12, 2);
            $table->integer("total_qty")->default(0);
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
        Schema::dropIfExists('goods');
    }
}
