<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanystructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companystructures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ParentCompanyID')->default(0);
            $table->integer('ChildCompanyID')->default(0);
            $table->integer('Active')->default(1);
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
        Schema::dropIfExists('companystructures');
    }
}
