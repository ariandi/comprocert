<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Ssclub extends Model
{
    protected $fillable = ['user_id','ProductID','NodeID','Score','Comment','Date',
    												'Active','page','PageMobile','ChangedByPersonID','CreatedByPersonID',
    											];
}
