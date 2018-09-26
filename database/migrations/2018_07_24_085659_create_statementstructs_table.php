<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementstructsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statementstructs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('child_id')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('active')->default(1);
            $table->integer('priority')->default(0);
            $table->integer('is_main_path')->default(0);
            $table->integer('InsertedByPersonID')->nullable();
            $table->integer('UpdatedByPersonID')->nullable();
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
        Schema::dropIfExists('statementstructs');
    }
}
