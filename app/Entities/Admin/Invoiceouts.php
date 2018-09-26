<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Invoiceouts extends Model
{
 
 	protected $fillable = 	[	
    							'Status','CompanyID','FromCompanyID','ContactPersonID','PersonID','FirstName','LastName',
    							'Phone','InvoiceDate','DueDate','ResponsiblePersonID','OrderDate','RequiredDate',
    							'DeliveryDate','DName','DAddress','DAddress2','DAddressNumber','DEmail','DCity','DZipCode',
    							'DCountry','DPoBox','DPoBoxCity','DPoBoxZipCode','DPoBoxZipCodeCity','Active',
    							'TS','ValidFrom','ValidTo','TotalCustPrice','EnableTaxFree','RefCustomer','DateShipped',
    							'IEmail','IName','IAddress','IAddress2','IAddressNumber','ICity','IZipCode','ICountry',
    							'IPoBox','IPoBoxCity','IPoBoxZipCode','IPoBoxZipCodeCity','VAddressNumber',
    							'VPoBoxZipCodeCity','CommentInternal','CommentCustomer','CommentCustomerPosition',
    							'DeliveryCondition','PaymentCondition','ProjectID','ProjectNameCustomer',
    							'ProjectNameInternal','ProjectStartDate','ProjectStopDate','created_at','updated_at',
    							'SalePersonID','CreatedByPersonID','InsertedByPersonID','UpdatedByPersonID',
    							'CreatedDateTime','TotalCostPrice','Paid','PaymentDate','Refund','PaymentMethods',
    							'PrePaymentAmount','Discount','VATDuty','TotalVat','InvoiceType','AccountPlanID','Dpack',
    							'KID','ExternalID','BankAccount','InvoiceFileID','RefInternal','Freight',
    							'MailSendtDateTime','CustomerViewedDateTime','CustomerViewedPersonID','IBAN',
    							'DepartmentID','DepartmentCustomer','Period','SessionID','CurrencyID'
    						];


}
