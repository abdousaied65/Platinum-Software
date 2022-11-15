<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosOpenElement extends Model
{
    protected $table = "pos_open_elements";
    protected $fillable = [
        'pos_open_id', 'company_id', 'product_id', 'product_unit_id', 'product_price', 'quantity', 'quantity_price'
    ];

    public function serials()
    {
        return $this->hasMany('\App\Models\PosSerial', 'pos_element_id', 'id');
    }

    public function PosOpen()
    {
        return $this->belongsTo('\App\Models\PosOpen', 'pos_open_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('\App\Models\Product', 'product_id', 'id');
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
