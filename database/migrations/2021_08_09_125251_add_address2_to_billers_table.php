<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddress2ToBillersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billers', function (Blueprint $table) {
            //
            $table->string('AddressNow')->default('0');
            $table->string('AddressCom')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billers', function (Blueprint $table) {
            //
            $table->dropColumn('AddressNow');
            $table->dropColumn('AddressCom');
        });
    }
}
