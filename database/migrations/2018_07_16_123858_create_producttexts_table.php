<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducttextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producttexts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ProductID');
            $table->string('LanguageID')->default('en');
            $table->string('ProductName')->nullable();
            $table->text('ProductText')->nullable();
            $table->integer('Active')->default(1);
            $table->integer('ChangedByPersonID')->nullable();
            $table->integer('CreatedByPersonID')->nullable();
            $table->text('TeaserText')->nullable();
            $table->text('SalesText')->nullable();
            $table->text('TechnicalText')->nullable();
            $table->text('FeatureText')->nullable();
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
        Schema::dropIfExists('producttexts');
    }
}
