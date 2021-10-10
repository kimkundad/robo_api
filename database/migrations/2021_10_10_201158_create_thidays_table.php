<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thidays', function (Blueprint $table) {
            $table->id();
            $table->string('name_day')->nullable();
            $table->string('desktop_img')->nullable();
            $table->string('mobile_img')->nullable();
            $table->integer('status')->default('0');
            $table->string('day_time')->nullable();
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
        Schema::dropIfExists('thidays');
    }
}
