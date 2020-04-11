<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('session_id')->unsigned()->references('id')->on('sessions');
            $table->string('duration')->default('00:00');
            $table->string('duration_seconds')->default('0');
            $table->string('link_raw')->nullable();
            $table->string('link_360')->nullable();
            $table->string('link_480')->nullable();
            $table->string('link_720')->nullable();
            $table->string('link_1080')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
