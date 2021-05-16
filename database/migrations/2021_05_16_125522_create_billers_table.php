<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billers', function (Blueprint $table) {
            $table->id();
            $table->string('biller_id')->nullable();
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();
            $table->text('company_type')->nullable();
            $table->text('business_type')->nullable();
            $table->string('id_card')->nullable();
            $table->string('bank_id')->default('0');
            $table->string('bank_name')->nullable();
            $table->string('bank_no')->nullable();
            $table->string('bank_major')->nullable();
            $table->string('user_id')->default('0');
            $table->integer('status')->default('0');
            $table->integer('status2')->default('0');
            $table->integer('process')->default('0');
            $table->string('admin_id')->default('0');
            $table->string('file_1')->nullable();
            $table->string('file_2')->nullable();
            $table->string('file_3')->nullable();
            $table->string('file_4')->nullable();
            $table->string('file_5')->nullable();
            $table->string('file_6')->nullable();
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
        Schema::dropIfExists('billers');
    }
}
