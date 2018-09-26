<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Languagestring extends Model
{
    protected $fillable = ['language_string_text_id', 'language_string', 'language_id', 'active'];
}
