<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nme_website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('facebook_image')->nullable();
            $table->string('facebook_title')->nullable();
            $table->string('facebook_detail')->nullable();
            $table->string('line_oa')->nullable();
            $table->string('line_oa_url')->nullable();
            $table->string('line_token')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('tax')->nullable();
            $table->string('company')->nullable();
            $table->text('address')->nullable();
            $table->text('google_analytic')->nullable();
            $table->longText('get_my_file')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
