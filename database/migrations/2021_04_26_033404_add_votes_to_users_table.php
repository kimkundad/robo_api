<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVotesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('age')->default('0');
            $table->string('study')->nullable();
            $table->string('novice')->nullable();
            $table->integer('terms')->default('0');
            $table->integer('policy')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('age');
            $table->dropColumn('study');
            $table->dropColumn('novice');
            $table->dropColumn('terms');
            $table->dropColumn('policy');
        });
    }
}
