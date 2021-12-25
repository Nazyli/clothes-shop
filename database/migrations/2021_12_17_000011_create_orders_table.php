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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_membership')->default(false);
            $table->string('email')->nullable();
            $table->text('full_address')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->boolean('is_confirm')->nullable();
            $table->unsignedBigInteger('confirm_by')->nullable();
            $table->foreign('confirm_by')->references('id')->on('users');
            $table->float('total_price', 12, 2)->nullable();
            $table->integer('total_qty')->nullable();
            $table->unsignedBigInteger('payments_id')->nullable();
            $table->foreign('payments_id')->references('id')->on('payment_methods');
            $table->string('url_evidence_transfer')->nullable();
            $table->string('no_resi')->nullable();
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
