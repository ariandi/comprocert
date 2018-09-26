<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXnodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xnodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('FromPersonID')->unsigned();
            $table->integer('NodeID')->unsigned();
            $table->string('Note');
            $table->date('Date')->nullable();
            $table->integer('InsertedByPersonID')->nullable();
            $table->integer('UpdatedByPersonID')->nullable();
            $table->integer('Active')->default(1);
            $table->string('MyWhy')->nullable();
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
        Schema::dropIfExists('xnodes');
    }
}
