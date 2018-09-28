<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['CompanyNumber','CompanyName','Phone','Fax','Status','Information','Email','WWW','ResponsiblePersonID',
    											'SalePersonID','Active','ValidFrom','ValidTo','Longitude','Latitude','SubscribeValue','CurrencyID',
    											'BankAccount','SWIFT','IBAN','BankName','DeliveryCondition','PaymentCondition','VatOutAccount',
    											'VatInAccount','VatInvestmentAccount','VatAccount','AccountSale','AccountInvestment','HourPrice',
    											'TravelPrice','CostPrice','AccountPlanID','PKPNumber','PKPUsedDate','EnableSaleNumberSequence',
    											'EnableBankNumberSequence','EnableCashNumberSequence','EnableBuyNumberSequence',
    											'EnableSalaryNumberSequence','EnableAutoNumberSequence','EnableWeeklysaleNumberSequence','LanguageID',
    											'InterestRate','InterestDate','ShareValue','ShareNumber','VoucherBankNumber','VoucherSaleNumber',
    											'VoucherBuyNumber','VoucherSalaryNumber','VoucherCashNumber','OpenMon','OpenTue','OpenWed','OpenThu',
    											'OpenFri','OpenSat','OpenSun','CloseMon','CloseTue','CloseWed','CloseThu','CloseFri','CloseSat','CloseSun',
    											'EnableTaxFree','EnableVat','Frittisisteledd','LogoMediaStorageID','ClassificationID','FoundedDate',
    											'TagLine','AddRegCode','Type','OrgNumber','Facebook','Twitter','LinkedIn','InsertedByPersonID',
    											'UpdatedByPersonID','isAccountSupplier','isAccountCustomer','isAccountProspect', 'Discount','ExternalID','DCity', 
                                                'phone1', 'phone2', 'phone3'];

    public static function getCompanyChild($id)
    {
        $companypersonstructs = Companystructure::select('c.id AS CompanyID', 'c.CompanyName')
                                ->join('companies AS c', 'c.id', '=', 'companystructures.ChildCompanyID')
                                ->where('c.Active', 1)
                                ->where([['companystructures.Active', '>', 0],['companystructures.ParentCompanyID', '=', $id]])
                                ->get();

        return $companypersonstructs;
    }
}
