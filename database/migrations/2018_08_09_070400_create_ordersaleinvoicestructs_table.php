<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersaleinvoicestructsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordersaleinvoicestructs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('OrderID');
            $table->integer('InvoiceID');
            $table->smallInteger('Active');
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
        Schema::dropIfExists('ordersaleinvoicestructs');
    }
}
