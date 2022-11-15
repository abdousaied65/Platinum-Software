<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyBillElement extends Model
{
    protected $table = "buy_bill_elements";
    protected $fillable = [
        'buy_bill_id','product_id','company_id','product_price','quantity','product_unit_id','quantity_price'
    ];
    public function serials(){
        return $this->hasMany('\App\Models\BuySerial','buy_element_id','id');
    }
    public function unit(){
        return $this->belongsTo('\App\Models\ProductUnit','product_unit_id','id');
    }
    public function BuyBill(){
        return $this->belongsTo('\App\Models\BuyBill','buy_bill_id','id');
    }
    public function product(){
        return $this->belongsTo('\App\Models\Product','product_id','id');
    }

    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }
}
