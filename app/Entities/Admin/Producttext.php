<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Producttext extends Model
{
    protected $fillable = ['ProductID','LanguageID','ProductName','ProductText','Active','ChangedByPersonID',
    												'CreatedByPersonID','TeaserText','SalesText', 'TechnicalText', 'FeatureText'];
}