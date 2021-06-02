<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMydevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mydevices', function (Blueprint $table) {
            $table->id();
            $table->string('divice_name')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('user_data_id')->nullable();
            $table->integer('user_id')->default('0');
            $table->integer('status')->default('0');
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
        Schema::dropIfExists('mydevices');
    }
}
