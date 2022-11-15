<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicSettings extends Model
{
    protected $table = "basic_settings";
    protected $fillable = [
        'company_id','header','footer','electronic_stamp'
    ];
    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }
}
