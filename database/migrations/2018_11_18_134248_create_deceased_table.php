<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeceasedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deceased', function ($table) {
            $table->increments('id');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('gender',20);
            $table->string('cause_of_death',200);
            $table->date('date_in');
            $table->date('date_out')->nullable();
            $table->integer('charges')->unsigned()->nullable();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->integer('undertaker_id')->unsigned()->nullable();
            $table->foreign('undertaker_id')->references('id')->on('undertakers');
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
        Schema::dropIfExists('deceased');
    }
}
