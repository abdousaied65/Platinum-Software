<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosSetting extends Model
{
    protected $table = "pos_settings";
    protected $fillable = [
        'company_id','branch_id', 'discount', 'tax','suspension', 'payment','fast_finish','product_image',
        'print_save','cancel','suspension_tab','edit_delete_tab','add_outer_client','add_product', 'bank_id','safe_id'
    ];

    public function company()
    {
        return $this->belongsTo('\App\Models\Company', 'company_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo('\App\Models\Branch', 'branch_id', 'id');
    }
    public function safe()
    {
        return $this->belongsTo('\App\Models\Safe', 'safe_id', 'id');
    }
    public function bank()
    {
        return $this->belongsTo('\App\Models\Bank', 'bank_id', 'id');
    }

}
