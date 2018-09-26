<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdercustTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('ordercust', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Status',15)->nullable();
            $table->integer('CompanyID')->nullable();
            $table->integer('ContactPersonID')->nullable();
            $table->integer('ResponsiblePersonID')->nullable();
            $table->dateTime('OrderDate')->nullable();
            $table->dateTime('RequiredDate')->nullable();
            $table->dateTime('DeliveryDate')->nullable();
            $table->double('Freight', 8, 2)->nullable();
            $table->string('DName')->nullable();
            $table->string('DAddress')->nullable();
            $table->string('DCity')->nullable();
            $table->string('DZipCode')->nullable();
            $table->string('DCountry')->nullable();
            $table->integer('Active')->default(1);
            $table->timestamp('TS')->nullable();
            $table->dateTime('ValidFrom')->nullable();
            $table->dateTime('ValidTo')->nullable();
            $table->decimal('TotalCustPrice', 11, 8)->nullable();
            $table->smallInteger('EnableTaxFree')->nullable();
            $table->string('RefCustomer')->nullable();
            $table->date('DateShipped')->nullable();
            $table->string('IEmail')->nullable();
            $table->string('DEmail')->nullable();
            $table->text('CommentInternal')->nullable();
            $table->text('CommentCustomer')->nullable();
            $table->string('RefInternal')->nullable();
            $table->integer('SalePersonID')->nullable();
            $table->integer('IAddressID')->nullable();
            $table->integer('DAddressID')->nullable(); 
            $table->string('IPoBoxZipCode')->nullable();
            $table->string('IPoBoxZipCodeCity')->nullable();
            $table->string('DPoBoxZipCode')->nullable();
            $table->string('DPoBoxZipCodeCity')->nullable();
            $table->string('IName')->nullable();
            $table->string('IAddress')->nullable();
            $table->string('ICity')->nullable();
            $table->string('IZipCode')->nullable();
            $table->string('ICountry')->nullable();
            $table->string('VPoBoxZipCodeCity')->nullable();
            $table->string('IPoBox',40)->nullable();
            $table->string('DPoBox',40)->nullable();
            $table->string('DPoBoxCity',40)->nullable();
            $table->string('IPoBoxCity',40)->nullable();
            $table->integer('CreatedByPersonID')->nullable();
            $table->integer('UpdatedByPersonID')->nullable();
            $table->decimal('TotalCostPrice', 11, 8)->nullable();
            $table->decimal('TotalVat', 11, 8)->nullable();
            $table->string('ProjectNameInternal')->nullable();
            $table->string('ProjectNameCustomer')->nullable();
            $table->bigInteger('PersonID')->nullable();
            $table->decimal('Discount', 11, 8)->nullable();
            $table->string('Dpack')->nullable();
            $table->string('VAddressNumber',10)->nullable();
            $table->string('IAddressNumber',10)->nullable();
            $table->string('DAddressNumber',10)->nullable();
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
        Schema::dropIfExists('ordercust');
    }
}
