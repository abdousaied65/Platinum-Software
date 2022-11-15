<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuySerial extends Model
{
    protected $table = "buy_serials";
    protected $fillable = [
        'buy_bill_id', 'buy_element_id', 'company_id', 'client_id', 'product_unit_id', 'serial_number'
    ];

    public function BuyBill()
    {
        return $this->belongsTo('\App\Models\BuyBill', 'buy_bill_id', 'id');
    }

    public function element()
    {
        return $this->belongsTo('\App\Models\BuyBillElement', 'buy_element_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo('\App\Models\Client', 'client_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo('\App\Models\ProductUnit', 'product_unit_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo('\App\Models\Company', 'company_id', 'id');
    }
}
