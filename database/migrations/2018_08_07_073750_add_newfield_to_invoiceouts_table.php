<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewfieldToInvoiceoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoiceouts', function (Blueprint $table) {
            $table->decimal('RetailKickbackPercent', 16, 5)->nullable();
            $table->bigInteger('RetailCompanyID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoiceouts', function (Blueprint $table) {
         $table->dropColumn(['RetailKickbackPercent', 'RetailCompanyID']);
        });
    }
}
