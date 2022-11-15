<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosSerial extends Model
{
    protected $table = "pos_serials";
    protected $fillable = [
        'pos_open_id', 'pos_element_id', 'company_id', 'client_id', 'product_unit_id', 'serial_number'
    ];

    public function PosOpen()
    {
        return $this->belongsTo('\App\Models\PosOpen', 'pos_open_id', 'id');
    }

    public function element()
    {
        return $this->belongsTo('\App\Models\PosOpenElement', 'pos_element_id', 'id');
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
