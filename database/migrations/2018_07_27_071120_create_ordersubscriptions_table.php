<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('ordersubscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('CompanyID')->nullable();
            $table->bigInteger('FromCompanyID')->nullable();
            $table->bigInteger('ContactPersonID')->nullable();
            $table->bigInteger('PersonID')->nullable();
            $table->string('Status')->nullable();
            $table->date('DeliveryDate')->nullable();
            $table->date('OrderDate')->nullable();
            $table->dateTime('RequiredDate')->nullable();
            $table->date('DateShipped')->nullable();
            $table->decimal('TotalCustPrice', 16, 5)->nullable();
            $table->decimal('TotalCostPrice', 16, 5)->nullable();
            $table->decimal('Discount', 16, 5)->nullable();
            $table->decimal('TotalVat', 16, 5)->nullable();
            $table->string('RefCustomer')->nullable();
            $table->integer('Active')->nullable();
            $table->bigInteger('AccountPlanID')->nullable();
            $table->dateTime('ValidFrom')->nullable();
            $table->dateTime('ValidTo')->nullable();
            $table->string('KID')->nullable();
            $table->string('RefInternal')->nullable();
            $table->bigInteger('SalePersonID')->nullable();
            $table->bigInteger('UpdatedByPersonID')->nullable();
            $table->bigInteger('InsertedByPersonID')->nullable();
            $table->bigInteger('ResponsiblePersonID')->nullable();
            $table->decimal('Freight', 16, 5)->nullable();
            $table->integer('Frequency')->nullable();
            $table->smallInteger('EnableTaxFree')->nullable();
            $table->dateTime('MailSendtDateTime')->nullable();
            $table->dateTime('CustomerViewedDateTime')->nullable();
            $table->dateTime('CustomerViewedPersonID')->nullable();
            $table->string('IBAN')->nullable();
            $table->integer('DepartmentID')->nullable();
            $table->string('DepartmentCustomer')->nullable();
            $table->string('Period')->nullable();
            $table->string('SessionID')->nullable();
            $table->char('CurrencyID')->nullable();
            $table->string('DName')->nullable();
            $table->string('DAddress')->nullable();
            $table->string('DAddress2')->nullable();
            $table->string('DAddressNumber')->nullable();
            $table->string('DZipCode')->nullable();
            $table->string('DCity')->nullable();
            $table->string('DCountry')->nullable();
            $table->string('DEmail')->nullable();
            $table->string('DPoBox')->nullable();
            $table->string('DPoBoxCity')->nullable();
            $table->string('DPoBoxZipCode')->nullable();
            $table->string('DPoBoxZipCodeCity')->nullable();
            $table->string('IAddress')->nullable();
            $table->string('IAddress2')->nullable();
            $table->string('IAddressNumber')->nullable();
            $table->string('IName')->nullable();
            $table->string('IEmail')->nullable();
            $table->string('IZipCode')->nullable();
            $table->string('ICity')->nullable();
            $table->string('ICountry')->nullable();
            $table->string('IPoBox')->nullable();
            $table->string('IPoBoxCity')->nullable();
            $table->string('IPoBoxZipCode')->nullable();
            $table->string('IPoBoxZipCodeCity')->nullable();
            $table->string('VAddressNumber')->nullable();
            $table->string('VPoBoxZipCodeCity')->nullable();
            $table->text('CommentCustomer')->nullable();
            $table->text('CommentInternal')->nullable();
            $table->char('CommentCustomerPosition')->nullable();
            $table->string('DeliveryCondition')->nullable();
            $table->string('PaymentCondition')->nullable();
            $table->integer('ProjectID')->nullable();
            $table->string('ProjectNameCustomer')->nullable();
            $table->string('ProjectNameInternal')->nullable();
            $table->decimal('RetailKickbackPercent', 16, 5)->nullable();
            $table->bigInteger('RetailCompanyID')->nullable();
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
        Schema::dropIfExists('ordersubscriptions');
    }
}
