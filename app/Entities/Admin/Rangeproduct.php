<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Rangeproduct extends Model
{
    protected $fillable = [	
    							'user_id', 'ProductID', 'Child1', 'Child2','Child3', 'Child4', 'Child5', 'Child6', 'nilai',
									'date', 'Active', 'ChangedByPersonID', 'CreatedByPersonID',
    						];
}
