<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('instructor_id')->unsigned()->references('id')->on('instructors');
            $table->string('name');
            $table->string('img')->nullable();
            $table->string('duration')->default('0 Hours and 0 Minutes');
            $table->string('duration_seconds')->default('0');
            $table->string('slug');
            $table->double('price');
            $table->text('about');
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
        Schema::dropIfExists('courses');
    }
}
