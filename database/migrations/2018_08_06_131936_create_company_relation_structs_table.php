<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyRelationStructsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_relation_structs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FromCompanyID');
            $table->integer('FromCompanyRelationTypeID');
            $table->integer('ToCompanyRelationTypeID');
            $table->integer('ToCompanyID');
            $table->integer('Active');
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
        Schema::dropIfExists('company_relation_structs');
    }
}
