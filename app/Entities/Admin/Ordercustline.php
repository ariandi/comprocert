<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Ordercustline extends Model
{
    protected $table = 'ordercustline';

    protected $fillable = 	[	
    							'ProductNumber','OrderID','ProductID','UnitCostPrice','UnitCustPrice','QuantityOrdered',
    							'QuantityDelivered','Vat','Active','LineNum','Comments','VatID','TaxFree','ValidFromDate',
    							'ValidToDate','ProductName','ProductVariantID','pricegroupid','InsertedByPersonID',
    							'UpdatedByPersonID','created_at','updated_at','Discount','TaxAmount',
    							'UnitCustPriceCurrencyID','UnitCostPriceCurrencyID','TS'
    						];
}
