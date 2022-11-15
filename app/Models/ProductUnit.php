<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    protected $table = "product_unit";
    protected $fillable = [
        'company_id','product_id','unit_id','wholesale_price','sector_price','first_balance','purchasing_price',
        'min_balance','type'
    ];
    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }
    public function unit(){
        return $this->belongsTo('\App\Models\Unit','unit_id','id');
    }
    public function product(){
        return $this->belongsTo('\App\Models\Product','product_id','id');
    }
    public function serials(){
        return $this->hasMany('\App\Models\ProductSerial','product_unit_id','id');
    }

}
