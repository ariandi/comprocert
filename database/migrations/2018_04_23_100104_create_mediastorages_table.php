<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediastoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediastorages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('external_url')->nullable();
            $table->string('extension_type')->nullable();
            $table->integer('active')->default('1');
            $table->string('path')->nullable();
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
        Schema::dropIfExists('mediastorages');
    }
}
