<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMerchantIdToBillers extends Migration
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
            $table->string('merchant_id')->nullable();
            $table->string('terminal_id')->nullable();
            $table->string('data1_id')->nullable();
            $table->string('data2_id')->nullable();
            $table->string('new_status1_id')->default('0');
            $table->string('new_status2_id')->default('0');
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
            $table->dropColumn('merchant_id');
            $table->dropColumn('terminal_id');
            $table->dropColumn('data1_id');
            $table->dropColumn('data2_id');
            $table->dropColumn('new_status1_id');
            $table->dropColumn('new_status2_id');
        });
    }
}
