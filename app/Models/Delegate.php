<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    protected $table = "delegates";
    protected $fillable = [
        'company_id','client_id','delegate_name'
    ];
    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }
    public function client(){
        return $this->belongsTo('\App\Models\Client','client_id','id');
    }
}
