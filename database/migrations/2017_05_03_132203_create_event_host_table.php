<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventHostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_host', function (Blueprint $table) {
            $table->increments('event_host_id');
            $table->string('name');
            $table->string('company');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->text('additional_info');
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
        Schema::dropIfExists('event_host');
    }
}
