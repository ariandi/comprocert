<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Ordersaleinvoicestructs extends Model
{
     protected $fillable = ['OrderID', 'InvoiceID', 'Active'];
}
