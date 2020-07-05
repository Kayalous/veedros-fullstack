<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_enrollments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('merchant_order_id', 15)->unique();
            $table->bigInteger('payment_id')->unsigned()->references('id')->on('payments')->nullable();
            $table->bigInteger('promo_code_id')->unsigned()->references('id')->on('promo_codes')->nullable();
            $table->bigInteger('user_id')->unsigned()->references('id')->on('users');
            $table->timestamp('paid_at')->nullable();
            $table->double('subtotal');
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
        Schema::dropIfExists('pending_enrollments');
    }
}
