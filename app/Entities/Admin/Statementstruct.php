<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Statementstruct extends Model
{
	protected $fillable = ['child_id','parent_id','active','priority','is_main_path','InsertedByPersonID','UpdatedByPersonID'];

	public function statement()
  {
      return $this->belongsTo('App\Entities\Admin\Statement', 'child_id');
  }
}
