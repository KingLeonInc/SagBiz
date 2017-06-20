<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_reg', function (Blueprint $table) {
            $table->increments('event_reg_id');
            $table->integer('event_id');
            $table->string('name');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('email');
            $table->date('bdate');
            $table->string('company');
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
        Schema::dropIfExists('event_reg');
    }
}
