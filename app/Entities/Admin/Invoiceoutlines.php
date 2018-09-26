<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Invoiceoutlines extends Model
{
     protected $fillable = 	[	
    							'id','LineNum','ProductNumber','InvoiceID','ProductID','ProductName','UnitCostPrice','
    							UnitCustPrice','QuantityOrdered','QuantityDelivered','Vat','Active','Comments','VatID','
    							TaxFree','ValidFromDate','ValidToDate','ProductVariantID','pricegroupid','
    							InsertedByPersonID','UpdatedByPersonID','Discount','TaxAmount','UnitCustPriceCurrencyID','
    							UnitCostPriceCurrencyID','created_at','updated_at'
    						];
}
