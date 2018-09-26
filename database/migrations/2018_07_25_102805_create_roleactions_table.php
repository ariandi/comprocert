<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roleactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Module')->default(null);
            $table->string('Action')->default(null);
            $table->integer('RoleID')->default(null);
            $table->integer('Access')->default(null);
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
        Schema::dropIfExists('roleactions');
    }
}
