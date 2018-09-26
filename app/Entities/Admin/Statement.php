<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
		protected $fillable = ['title','tablename','primarykey','description','active','InsertedByPersonID','UpdatedByPersonID'];

		public function statementStruct()
  {
      return $this->hasMany('App\Entities\Admin\Statementstruct');
  }
}
