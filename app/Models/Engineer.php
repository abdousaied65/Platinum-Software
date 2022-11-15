<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Engineer extends Model
{
    protected $table = "engineers";
    protected $fillable = [
        'company_id','client_id','name','phone','address','commission_rate'
    ];
    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }

    public function client(){
        return $this->belongsTo('\App\Models\Client','cleint_id','id');
    }

}
