<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductmediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productmedias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ProductID');
            $table->integer('ProductMediaStorageID');
            $table->string('Heading')->nullable();
            $table->string('Description')->nullable();
            $table->integer('Active')->default(1);
            $table->integer('ChangedByPersonID')->nullable();
            $table->integer('CreatedByPersonID')->nullable();
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
        Schema::dropIfExists('productmedias');
    }
}
