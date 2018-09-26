<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Xnode extends Model
{
    protected $fillable = ['user_id','MyWhy','FromPersonID','NodeID','Note','Date','UpdatedByPersonID','InsertedByPersonID', 'Active'];

    public function getActionList()
    {
    	$statement = Statement::where('statements.active', 1)
    						->where('statements.id', $this->NodeID);

    	return $statement->first();
    }
}
