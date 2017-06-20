<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('event_id');
            $table->string('title');
            $table->text('summary');
            $table->text('description');
            $table->text('event_img');
            $table->integer('event_type');
            $table->integer('event_host');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->double('price');
            $table->enum('availability', ['limited', 'unlimited']);
            $table->bigInteger('max_guest');
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
        Schema::dropIfExists('event');
    }
}
