<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = [
        'company_id','store_id','category_id','product_name','expire_date',
        'product_pic','code_universal','description','sub_category_id','color'
    ];
    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }
    public function store(){
        return $this->belongsTo('\App\Models\Store','store_id','id');
    }
    public function category(){
        return $this->belongsTo('\App\Models\Category','category_id','id');
    }
    public function serials(){
        return $this->hasMany('\App\Models\ProductSerial','product_id','id');
    }
    public function subcategory(){
        return $this->belongsTo('\App\Models\SubCategory','sub_category_id','id');
    }
    public function units(){
        return $this->hasMany('\App\Models\ProductUnit','product_id','id');
    }
    public function buy_bill_elements(){
        return $this->hasMany('\App\Models\BuyBillElement','product_id','id');
    }
    public function buy_bill_return(){
        return $this->hasMany('\App\Models\BuyBillReturn','product_id','id');
    }
    public function sale_bill_elements(){
        return $this->hasMany('\App\Models\SaleBillElement','product_id','id');
    }
    public function sale_bill_return(){
        return $this->hasMany('\App\Models\SaleBillReturn','product_id','id');
    }
    public function gifts(){
        return $this->hasMany('\App\Models\Gift','product_id','id');
    }
    public function quotation_elements(){
        return $this->hasMany('\App\Models\QuotationElement','product_id','id');
    }
}
