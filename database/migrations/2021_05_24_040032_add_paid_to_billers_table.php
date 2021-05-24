<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToBillersTable extends Migration
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
            $table->string('bill_type')->default('0');
            $table->string('address_id')->default('0');
            $table->string('file_7')->nullable();
            $table->string('file_8')->nullable();
            $table->string('url_domain_name')->nullable();
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
            $table->dropColumn('bill_type');
            $table->dropColumn('address_id');
            $table->dropColumn('file_7');
            $table->dropColumn('file_8');
            $table->dropColumn('url_domain_name');
        });
    }
}
