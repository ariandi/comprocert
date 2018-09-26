<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Mediastorages extends Model
{
    protected $fillable = ['title', 'external_url', 'extension_type', 'active', 'path', 'media_id', 'tablename'];
}
