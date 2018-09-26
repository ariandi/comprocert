<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('alias')->nullable();
            $table->string('description')->nullable();
            $table->string('keyword')->nullable();
            $table->integer('active')->default('1');
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->text('content1')->nullable();
            $table->text('content2')->nullable();
            $table->text('content3')->nullable();
            $table->text('content4')->nullable();
            $table->integer('media1')->nullable();
            $table->integer('media2')->nullable();
            $table->integer('media3')->nullable();
            $table->integer('media4')->nullable();
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
        Schema::dropIfExists('nodes');
    }
}
