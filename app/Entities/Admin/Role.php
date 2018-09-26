<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['RoleName','Interface','Description','Active','DefaultInterface','DefaultModule','DefaultTemplate',
    												'Priority','ChangedByPersonID','CreatedByPersonID',
    											];
}
