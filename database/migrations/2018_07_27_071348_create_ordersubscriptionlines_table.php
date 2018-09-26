<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersubscriptionlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordersubscriptionlines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('LineNum')->nullable(1);
            $table->string('ProductNumber')->nullable();
            $table->bigInteger('OrderID')->nullable();
            $table->integer('ProductID')->nullable();
            $table->string('ProductName')->nullable();
            $table->decimal('UnitCostPrice', 16, 5)->nullable();
            $table->decimal('UnitCustPrice', 16, 5)->nullable();
            $table->decimal('QuantityOrdered', 16, 5)->nullable();
            $table->decimal('QuantityDelivered', 16, 5)->nullable();
            $table->decimal('Vat', 16, 5)->nullable();
            $table->integer('Active')->nullable(1);
            $table->string('Comments')->nullable();
            $table->integer('VatID')->nullable();
            $table->integer('TaxFree')->nullable();
            $table->dateTime('ValidFromDate')->nullable();
            $table->dateTime('ValidToDate')->nullable();
            $table->integer('ProductVariantID')->nullable();
            $table->integer('pricegroupid')->nullable();
            $table->integer('InsertedByPersonID')->nullable();
            $table->integer('UpdatedByPersonID')->nullable();
            $table->decimal('Discount', 16, 5)->nullable();
            $table->decimal('TaxAmount', 16, 5)->nullable();
            $table->char('UnitCustPriceCurrencyID', 100)->nullable();
            $table->char('UnitCostPriceCurrencyID', 100)->nullable();
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
        Schema::dropIfExists('ordersubscriptionlines');
    }
}
