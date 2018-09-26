    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CompanyNumber')->nullable();
            $table->string('CompanyName')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Fax')->nullable();
            $table->string('Status')->nullable();
            $table->text('Information')->nullable();
            $table->string('Email')->nullable();
            $table->string('WWW')->nullable();
            $table->integer('ResponsiblePersonID')->nullable();
            $table->integer('SalePersonID')->nullable();
            $table->integer('Active')->default(1);
            $table->date('ValidFrom')->nullable();
            $table->date('ValidTo')->nullable();
            $table->decimal('Longitude', 10, 8)->nullable();
            $table->decimal('Latitude', 11, 8)->nullable();
            $table->integer('SubscribeValue')->nullable();
            $table->string('CurrencyID')->nullable();
            $table->string('BankAccount')->nullable();
            $table->string('SWIFT')->nullable();
            $table->string('IBAN')->nullable();
            $table->string('BankName')->nullable();
            $table->text('DeliveryCondition')->nullable();
            $table->text('PaymentCondition')->nullable();
            $table->integer('VatOutAccount')->nullable();
            $table->integer('VatInAccount')->nullable();
            $table->integer('VatInvestmentAccount')->nullable();
            $table->integer('VatAccount')->nullable();
            $table->string('AccountSale')->nullable();
            $table->string('AccountInvestment')->nullable();
            $table->decimal('HourPrice', 16,5)->nullable();
            $table->decimal('TravelPrice', 16,5)->nullable();
            $table->decimal('CostPrice', 16,5)->nullable();
            $table->integer('AccountPlanID')->nullable();
            $table->string('PKPNumber')->nullable();
            $table->integer('PKPUsedDate')->nullable();
            $table->integer('EnableSaleNumberSequence')->nullable();
            $table->integer('EnableBankNumberSequence')->nullable();
            $table->integer('EnableCashNumberSequence')->nullable();
            $table->integer('EnableBuyNumberSequence')->nullable();
            $table->integer('EnableSalaryNumberSequence')->nullable();
            $table->integer('EnableAutoNumberSequence')->nullable();
            $table->integer('EnableWeeklysaleNumberSequence')->nullable();
            $table->string('LanguageID')->nullable();
            $table->decimal('InterestRate', 16,5)->nullable();
            $table->date('InterestDate')->nullable();
            $table->integer('ShareValue')->nullable();
            $table->integer('ShareNumber')->nullable();
            $table->string('VoucherBankNumber')->nullable();
            $table->string('VoucherSaleNumber')->nullable();
            $table->string('VoucherBuyNumber')->nullable();
            $table->string('VoucherSalaryNumber')->nullable();
            $table->string('VoucherCashNumber')->nullable();
            $table->integer('OpenMon')->nullable();
            $table->integer('OpenTue')->nullable();
            $table->integer('OpenWed')->nullable();
            $table->integer('OpenThu')->nullable();
            $table->integer('OpenFri')->nullable();
            $table->integer('OpenSat')->nullable();
            $table->integer('OpenSun')->nullable();
            $table->integer('CloseMon')->nullable();
            $table->integer('CloseTue')->nullable();
            $table->integer('CloseWed')->nullable();
            $table->integer('CloseThu')->nullable();
            $table->integer('CloseFri')->nullable();
            $table->integer('CloseSat')->nullable();
            $table->integer('CloseSun')->nullable();
            $table->integer('EnableTaxFree')->nullable();
            $table->integer('EnableVat')->nullable();
            $table->decimal('Frittisisteledd', 16,5)->nullable();
            $table->integer('LogoMediaStorageID')->nullable();
            $table->integer('ClassificationID')->nullable();
            $table->date('FoundedDate')->nullable();
            $table->integer('TagLine')->nullable();
            $table->string('AddRegCode')->nullable();
            $table->integer('Type')->nullable();
            $table->string('OrgNumber')->nullable();
            $table->string('Facebook')->nullable();
            $table->string('Twitter')->nullable();
            $table->string('LinkedIn')->nullable();
            $table->integer('InsertedByPersonID')->nullable();
            $table->integer('UpdatedByPersonID')->nullable();
            $table->integer('isAccountSupplier')->nullable();
            $table->integer('isAccountCustomer')->nullable();
            $table->integer('isAccountProspect')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
