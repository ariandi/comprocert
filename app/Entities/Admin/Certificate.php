<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
    	'company_id','company_name','certificate_no','file','status',
    ];
}
