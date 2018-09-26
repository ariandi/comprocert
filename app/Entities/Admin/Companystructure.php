<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Companystructure extends Model
{
    protected $fillable = ['ParentCompanyID', 'ChildCompanyID', 'Active', 'InsertedByPersonID', 'UpdatedByPersonID'];
}
