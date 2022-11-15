<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeZone extends Model
{
    protected $table = "timezones";
    protected $fillable = [
        'timezone','name_ar','name_en'
    ];
}
