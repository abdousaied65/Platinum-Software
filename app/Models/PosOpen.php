<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosOpen extends Model
{
    protected $table = "pos_open";
    protected $fillable = [
        'company_id','client_id','outer_client_id','notes','status','shift_id'
    ];
    public function elements(){
        return $this->hasMany('\App\Models\PosOpenElement','pos_open_id','id');
    }
    public function discount(){
        return $this->hasOne('\App\Models\PosOpenDiscount','pos_open_id','id');
    }
    public function tax(){
        return $this->hasOne('\App\Models\PosOpenTax','pos_open_id','id');
    }
    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }
    public function outerClient(){
        return $this->belongsTo('\App\Models\OuterClient','outer_client_id','id');
    }
    public function client(){
        return $this->belongsTo('\App\Models\Client','client_id','id');
    }
}
