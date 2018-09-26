<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class CompanyRelationStruct extends Model
{
    protected $fillable = ['FromCompanyID', 'FromCompanyRelationTypeID', 'ToCompanyRelationTypeID', 'ToCompanyID', 'Active',
														'InsertedByPersonID', 'UpdatedByPersonID',];

		public static function getCompanyName($id)
		{
			$company = Company::find($id);
			return $company->CompanyName;
		}
}
