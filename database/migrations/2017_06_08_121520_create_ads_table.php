<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('ad_id');
            $table->string('ad_title');
            $table->enum('ad_type', ['photo', 'video']);
            $table->text('ad_link');
            $table->text('ad_background_photo'); // AD BACKGROUND IMAGE
            $table->string('ad_video_file')->nullable(); // VIDEO FILE OR LINK 
            $table->text('ad_video_link')->nullable();
            $table->dateTime('ad_start_date');
            $table->dateTime('ad_end_date');
            $table->timestamps();
            $table->enum('enabled', [0, 1])->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
