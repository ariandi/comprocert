<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extraquestions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('ProductID')->default(0);
            $table->integer('NodeID')->default(0);
            $table->integer('Score')->default(0);
            $table->string('Comment')->default(0);
            $table->date('Date')->nullable();
            $table->integer('Active')->default(1);
            $table->integer('page')->default(0);
            $table->integer('PageMobile')->default(0);
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
        Schema::dropIfExists('extraquestions');
    }
}
