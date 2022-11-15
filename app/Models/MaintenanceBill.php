<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceBill extends Model
{
    protected $table = "maintenance_bills";
    protected $fillable = [
        'bill_id','company_id', 'client_id', 'status', 'maintenance_device_id', 'engineer_id', 'engineer_evaluation', 'maintenance_type',
        'spare_parts_cost', 'maintenance_cost', 'total_cost', 'delegate_name', 'maintenance_place', 'repair_cost', 'delegate_cost',
        'owner_approval', 'notes','date'
    ];

    public function elements()
    {
        return $this->hasMany('\App\Models\MaintenanceBillElement', 'maintenance_bill_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo('\App\Models\Company', 'company_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo('\App\Models\Client', 'client_id', 'id');
    }

    public function MaintenanceDevice()
    {
        return $this->belongsTo('\App\Models\MaintenanceDevice', 'maintenance_device_id', 'id');
    }

    public function engineer()
    {
        return $this->belongsTo('\App\Models\Engineer', 'engineer_id', 'id');
    }
}
