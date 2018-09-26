<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['ProductNumber','SupplierID','UnitCostPrice','UnitCustPrice','Active','ValidFrom','ValidTo',
    												'ProductHeight', 'ProductWidth','ProductLength','ProductWeight','TaxFreeCustPrice','ProductUnit','VatID',
    												'ProductCurrency', 'ChangedByPersonID','CreatedByPersonID','AccountPlanID','ClassificationID','ProjectID',
    												'Stock','EAN','Unit', 'UnitPerLayer','ProductVolume','QuantityPerUnit',
    												'LayersPerPallet','ProductVolumeUnit'];

	public function getProdNameOne($LangID = 'en')
  {
      return $this->hasOne('App\Entities\Admin\Producttext', 'ProductID')->where(['Active' => 1, 'LanguageID' => $LangID])->first();
  }
}