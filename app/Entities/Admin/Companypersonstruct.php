<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Companypersonstruct extends Model
{
    protected $fillable = ['user_id', 'Active', 'CompanyID', 'InsertedByPersonID', 'UpdatedByPersonID'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getUsersCompany()
    {
    		$users = \App\User::select('users.first_name', 'users.last_name', 'users.email', 'users.id')
    						->join('companypersonstructs AS cps', 'cps.user_id', '=', 'users.id')
    						->where(['cps.Active' => 1, 'users.active' => 1, 'cps.CompanyID' => $this->CompanyID])
    						->get();
        return $users;
    }
}
