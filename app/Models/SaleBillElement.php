<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleBillElement extends Model
{
    protected $table = "sale_bill_elements";
    protected $fillable = [
        'sale_bill_id','company_id','product_id','product_unit_id','product_price','quantity','quantity_price'
    ];

    public function serials()
    {
        return $this->hasMany('\App\Models\SaleSerial', 'sale_element_id', 'id');
    }

    public function SaleBill(){
        return $this->belongsTo('\App\Models\SaleBill','sale_bill_id','id');
    }
    public function unit(){
        return $this->belongsTo('\App\Models\ProductUnit','product_unit_id','id');
    }
    public function product(){
        return $this->belongsTo('\App\Models\Product','product_id','id');
    }
    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }
}
