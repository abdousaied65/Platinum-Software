<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceDevice extends Model
{
    protected $table = "maintenance_devices";
    protected $fillable = [
        'company_id', 'client_id', 'store_id', 'device_owner_name', 'device_owner_phone', 'device_owner_address',
        'receipt_number', 'received_date', 'device_name', 'device_type', 'device_serial', 'device_issue',
        'device_pic', 'owner_complain', 'warranty', 'warranty_period', 'expected_delivery_date', 'notes', 'approximate_cost'
    ];

    public function company()
    {
        return $this->belongsTo('\App\Models\Company', 'company_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo('\App\Models\Client', 'client_id', 'id');
    }

    public function Bill()
    {
        return $this->hasOne('\App\Models\MaintenanceBill', 'maintenance_device_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo('\App\Models\Store', 'store_id', 'id');
    }
    public function deviceType()
    {
        return $this->belongsTo('\App\Models\DeviceType', 'device_type', 'id');
    }
    public function deviceIssue()
    {
        return $this->belongsTo('\App\Models\DeviceIssue', 'device_issue', 'id');
    }
}
