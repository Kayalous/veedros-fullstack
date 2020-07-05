<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePendingEnrollmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_pending_enrollment', function (Blueprint $table) {
            $table->bigInteger('course_id')->unsigned()->references('id')->on('courses');
            $table->bigInteger('pending_enrollment_id')->unsigned()->references('id')->on('pending_enrollments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_pending_enrollment');
    }
}
