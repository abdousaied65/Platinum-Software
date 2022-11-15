<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductSerial extends Model
{
    protected $table = "product_serials";
    protected $fillable = [
        'company_id','client_id','product_id','product_unit_id','serial_number','status'
    ];
    public function company(){
        return $this->belongsTo('\App\Models\Company','company_id','id');
    }
    public function client(){
        return $this->belongsTo('\App\Models\Client','client_id','id');
    }
    public function product(){
        return $this->belongsTo('\App\Models\Product','product_id','id');
    }
    public function product_unit(){
        return $this->belongsTo('\App\Models\ProductUnit','product_unit_id','id');
    }
}
