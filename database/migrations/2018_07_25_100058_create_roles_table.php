<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('RoleName')->nullable();
            $table->string('Interface')->nullable();
            $table->text('Description')->nullable();
            $table->integer('Active')->default(1);
            $table->string('DefaultInterface')->nullable();
            $table->string('DefaultModule')->nullable();
            $table->string('DefaultTemplate')->nullable();
            $table->integer('Priority')->default(100);
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
        Schema::dropIfExists('roles');
    }
}
