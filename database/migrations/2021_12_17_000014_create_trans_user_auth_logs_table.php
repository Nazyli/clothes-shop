<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransUserAuthLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_user_auth_logs', function (Blueprint $table) {
            $table->id();
            $table->string('auth_action');
            $table->string('auth_status');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('device')->nullable();
            $table->string('platform')->nullable();
            $table->string('browser')->nullable();

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
        Schema::dropIfExists('trans_user_auth_logs');
    }
}
