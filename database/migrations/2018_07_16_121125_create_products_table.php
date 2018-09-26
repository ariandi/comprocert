<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ProductNumber')->nullable();
            $table->integer('SupplierID')->nullable();
            $table->decimal('UnitCostPrice', 16, 5)->nullable();
            $table->decimal('UnitCustPrice', 16, 5)->nullable();
            $table->integer('Active')->default(1);
            $table->date('ValidFrom')->nullable();
            $table->date('ValidTo')->nullable();
            $table->decimal('ProductHeight', 16, 5)->nullable();
            $table->decimal('ProductWidth', 16, 5)->nullable();
            $table->decimal('ProductLength', 16, 5)->nullable();
            $table->decimal('ProductWeight', 16, 5)->nullable();
            $table->decimal('TaxFreeCustPrice', 16, 5)->nullable();
            $table->string('ProductUnit')->nullable();
            $table->integer('VatID')->nullable();
            $table->string('ProductCurrency')->nullable();
            $table->integer('ChangedByPersonID')->nullable();
            $table->integer('CreatedByPersonID')->nullable();
            $table->integer('AccountPlanID')->nullable();
            $table->integer('ClassificationID')->nullable();
            $table->integer('ProjectID')->nullable();
            $table->decimal('Stock', 16,5)->nullable();
            $table->string('EAN')->nullable();
            $table->integer('Unit')->nullable();
            $table->integer('UnitPerLayer')->default(0);
            $table->decimal('ProductVolume', 16, 5)->nullable();
            $table->integer('QuantityPerUnit')->nullable();
            $table->decimal('LayersPerPallet', 16, 5)->nullable();
            $table->integer('ProductVolumeUnit')->default(0);
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
        Schema::dropIfExists('products');
    }
}
