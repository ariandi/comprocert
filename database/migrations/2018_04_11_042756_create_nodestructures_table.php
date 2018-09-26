<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodestructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodestructures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('child_node_id')->default('0');
            $table->integer('parent_node_id')->default('0');
            $table->integer('active')->default('1');
            $table->integer('priority')->default('0');
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
        Schema::dropIfExists('nodestructures');
    }
}
