<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Ordersubscriptionlines extends Model
{
    protected $fillable = 	[	
    							'id','LineNum','ProductNumber','OrderID','ProductID','ProductName','UnitCostPrice','
    							UnitCustPrice','QuantityOrdered','QuantityDelivered','Vat','Active','Comments','VatID','
    							TaxFree','ValidFromDate','ValidToDate','ProductVariantID','pricegroupid','
    							InsertedByPersonID','UpdatedByPersonID','Discount','TaxAmount','UnitCustPriceCurrencyID','
    							UnitCostPriceCurrencyID','created_at','updated_at'
    						];
}
