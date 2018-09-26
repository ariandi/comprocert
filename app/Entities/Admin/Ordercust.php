<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Ordercust extends Model
{
    protected $table = 'ordercust';

    protected $fillable = 	[	
    							'Status','CompanyID','ContactPersonID','ResponsiblePersonID','OrderDate','RequiredDate',
    							'DeliveryDate','DName','DAddress','DEmail','DCity','DZipCode','DCountry','Active',
    							'TS','ValidFrom','ValidTo','TotalCustPrice','EnableTaxFree','RefCustomer','DateShipped',
    							'IEmail','IName','IAddress','ICity','IZipCode','ICountry','CommentInternal','CommentCustomer',
    							'SalePersonID','CreatedByPersonID','UpdatedByPersonID','created_at','updated_at','TotalCostPrice',
    							'Discount'
    						];
}
