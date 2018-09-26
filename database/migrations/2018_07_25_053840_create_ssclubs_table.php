<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsclubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssclubs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ClubName')->default(0);
            $table->integer('ClubGroup')->default(0);
            $table->integer('ClubBranch')->default(0);
            $table->integer('Sport')->default(0);
            $table->integer('SportBranch')->default(0);
            $table->integer('Leder')->default(0);
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
        Schema::dropIfExists('ssclubs');
    }
}
