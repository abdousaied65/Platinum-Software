<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceIssue extends Model
{
    protected $table = "devices_issues";
    protected $fillable = [
        'company_id','client_id','issue'
    ];
    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }
    public function client(){
        return $this->belongsTo('\App\Models\Client','client_id','id');
    }
}
