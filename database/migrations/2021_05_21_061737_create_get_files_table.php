<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGetFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('get_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->string('cat_id')->default('0');
            $table->string('file_size')->nullable();
            $table->string('store_file')->nullable();
            $table->text('file_detail')->nullable();
            $table->string('status')->default('0');
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
        Schema::dropIfExists('get_files');
    }
}
