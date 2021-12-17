<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->boolean('is_membership')->default(false);
            $table->string('email')->unique();
            $table->text('full_address');
            $table->integer('zip_code');
            $table->string('lat');
            $table->string('long');
            $table->boolean('is_confirm');
            $table->unsignedBigInteger('confirm_by');
            $table->foreign('confirm_by')->references('id')->on('users');
            $table->integer('total_price');
            $table->integer('total_qty');
            $table->unsignedBigInteger('payments_id');
            $table->foreign('payments_id')->references('id')->on('payment_methods');
            $table->string('url_evidence_transfer')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
