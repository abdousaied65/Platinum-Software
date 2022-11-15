<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenancePlace extends Model
{
    protected $table = "maintenance_places";
    protected $fillable = [
        'company_id','client_id','place_name'
    ];
    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }
    public function client(){
        return $this->belongsTo('\App\Models\Client','client_id','id');
    }
}
