<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default('0');
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('phone')->nullable();
            $table->string('id_card')->nullable();
            $table->string('company')->nullable();
            $table->string('company2')->nullable();
            $table->string('email')->nullable();
            $table->string('address_no')->nullable();
            $table->string('address_name')->nullable();
            $table->string('soi')->nullable();
            $table->string('road')->nullable();
            $table->string('province')->nullable();
            $table->string('county')->nullable();
            $table->string('district')->nullable();
            $table->string('postal_code')->nullable();
            $table->integer('type')->default('0');
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
        Schema::dropIfExists('text_addresses');
    }
}
