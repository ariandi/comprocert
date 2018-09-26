<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Productmedia extends Model
{
		protected $table = 'productmedias';
    protected $fillable = ['ProductID', 'ProductMediaStorageID', 'Heading', 'Description', 'Active', 'ChangedByPersonID', 
    												'CreatedByPersonID'];
}