<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftReport extends Model
{
    protected $table = "shift_report";
    protected $fillable = [
        'company_id','client_id','branch_id', 'shift_id', 'system_total','actual_total','difference_amount'
    ];

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
    public function shift()
    {
        return $this->belongsTo('\App\Models\Shift', 'shift_id', 'id');
    }

    protected $casts = [
        'start_date_time' => 'datetime',
        'end_date_time' => 'datetime',
    ];
}
