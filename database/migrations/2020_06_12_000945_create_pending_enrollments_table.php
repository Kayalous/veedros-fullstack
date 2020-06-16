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
            $table->text('merchant_order_id')->unique();
            $table->bigInteger('user_id')->unsigned()->references('id')->on('users');
            $table->bigInteger('course_id')->unsigned()->references('id')->on('courses');
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