<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePromoCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_promo_code', function (Blueprint $table) {
            $table->bigInteger('course_id')->unsigned()->references('id')->on('courses');
            $table->bigInteger('promo_code_id')->unsigned()->references('id')->on('promo_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_promo_code');
    }
}
