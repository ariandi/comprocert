<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Ordersubscriptions extends Model
{
   protected $fillable = 	[	
    							'id','CompanyID','FromCompanyID','ContactPersonID','PersonID',
    							'Status','DeliveryDate','OrderDate','RequiredDate','DateShipped',
                                'TotalCustPrice','TotalCostPrice','Discount','TotalVat','RefCustomer','Active',
                                'AccountPlanID','ValidFrom','ValidTo','KID','RefInternal','SalePersonID',
                                'InsertedByPersonID','UpdatedByPersonID','ResponsiblePersonID','Freight','Frequency',
                                'EnableTaxFree','MailSendtDateTime','CustomerViewedDateTime','CustomerViewedPersonID',
                                'IBAN','DepartmentID','DepartmentCustomer','Period','SessionID','CurrencyID',
                                'DName','DAddress','DAddress2','DAddressNumber','DEmail','DCity','DZipCode',
    							'DCountry','DPoBox','DPoBoxCity','DPoBoxZipCode','DPoBoxZipCodeCity',
    							'IAddress','IAddress2','IAddressNumber','IEmail','IName','ICity','IZipCode','ICountry',
    							'IPoBox','IPoBoxCity','IPoBoxZipCode','IPoBoxZipCodeCity','VAddressNumber',
                                'VPoBoxZipCodeCity','CommentInternal','CommentCustomer','CommentCustomerPosition',
    							'DeliveryCondition','PaymentCondition','ProjectID','ProjectNameCustomer',
    							'ProjectNameInternal','RetailCompanyID','RetailKickbackPercent','created_at','updated_at'
    						];
}
