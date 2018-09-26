<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Roleaction extends Model
{
    protected $fillable = ['Module','Action','RoleID','Access','ChangedByPersonID','CreatedByPersonID',];
}
