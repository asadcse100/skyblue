<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticOption extends Model
{
    protected $table = 'static_options';
    protected $fillable = ['option_name','option_value'];

}
