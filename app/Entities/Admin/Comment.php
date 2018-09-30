<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    	'name', 'email', 'subject', 'message'
    ]; 
}
