<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Roleperson extends Model
{
    protected $fillable = ['RoleID','user_id','CompanyID','Active','ChangedByPersonID','CreatedByPersonID'];
}
