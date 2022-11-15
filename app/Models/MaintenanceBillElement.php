<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceBillElement extends Model
{
    protected $table = "maintenance_bills_elements";
    protected $fillable = [
        'maintenance_bill_id', 'company_id', 'product_id', 'product_price', 'quantity', 'quantity_price'
    ];

    public function company()
    {
        return $this->belongsTo('\App\Models\Company', 'company_id', 'id');
    }
    public function MaintenanceBill()
    {
        return $this->belongsTo('\App\Models\MaintenanceBill', 'maintenance_bill_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo('\App\Models\Product', 'product_id', 'id');
    }
}
