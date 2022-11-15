<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleSerial extends Model
{
    protected $table = "sales_serials";
    protected $fillable = [
        'sale_bill_id', 'sale_element_id', 'company_id', 'client_id', 'product_unit_id', 'serial_number'
    ];

    public function SaleBill()
    {
        return $this->belongsTo('\App\Models\SaleBill', 'sale_bill_id', 'id');
    }

    public function element()
    {
        return $this->belongsTo('\App\Models\SaleBillElement', 'sale_element_id', 'id');
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
