<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosShift extends Model
{
    protected $table = "pos_shifts";
    protected $fillable = [
        'company_id','client_id','branch_id', 'status', 'cashier_drawer_balance','previous_shift_balance'
        ,'difference_balance', 'start_date_time', 'end_date_time','notes','next_shift_balance','actual_cash','actual_bank'
        ,'safe_id','transfer_safe_amount'
    ];

    public function safe()
    {
        return $this->belongsTo('\App\Models\Safe', 'safe_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo('\App\Models\Company', 'company_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo('\App\Models\Branch', 'branch_id', 'id');
    }
    public function client()
    {
        return $this->belongsTo('\App\Models\Client', 'client_id', 'id');
    }
    public function PosBills(){
        return $this->hasMany('\App\Models\PosOpen', 'shift_id', 'id');
    }

    protected $casts = [
        'start_date_time' => 'datetime',
        'end_date_time' => 'datetime',
    ];
}
