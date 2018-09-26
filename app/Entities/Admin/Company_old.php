<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'company';

    protected $fillable = 	[	
    							'company_id','company_name','phone1','phone2','phone3','address1','address2','email','website',
    							'datefrom','active','insert_by','insert_date','update_by','update_date'
    						];
}
