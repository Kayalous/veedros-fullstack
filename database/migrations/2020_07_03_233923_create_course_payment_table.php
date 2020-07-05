<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_payment', function (Blueprint $table) {
            $table->bigInteger('course_id')->unsigned()->references('id')->on('courses');
            $table->bigInteger('payment_id')->unsigned()->references('id')->on('payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_payment');
    }
}
