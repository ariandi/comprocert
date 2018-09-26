<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfmenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confmenus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MenuName')->nullable();
            $table->string('MenuValue')->nullable();
            $table->string('MenuChoice')->nullable();
            $table->string('LanguageID')->default('en');
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
        Schema::dropIfExists('confmenus');
    }
}
