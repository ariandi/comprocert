<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangeproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rangeproducts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(null);
            $table->integer('ProductID')->default(null);
            $table->decimal('Child1',16,2)->default(null);
            $table->decimal('Child2',16,2)->default(null);
            $table->decimal('Child3',16,2)->default(null);
            $table->decimal('Child4',16,2)->default(null);
            $table->decimal('Child5',16,2)->default(null);
            $table->decimal('Child6',16,2)->default(null);
            $table->decimal('nilai',16,2)->default(null);
            $table->date('date')->default(null);
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
        Schema::dropIfExists('rangeproducts');
    }
}
