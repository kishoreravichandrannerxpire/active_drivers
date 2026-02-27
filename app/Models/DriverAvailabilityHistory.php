<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverAvailabilityHistory extends Model
{
    protected $table = 'driver_availability_history';
    protected $fillable = [
        'driver_availability_id',
        'drivers_id',
        'from_date_time',
        'to_date_time',
        'status',
        'action'
    ];

    public function driverAvailability()
    {
        return $this->belongsTo(DriverAvailability::class, 'driver_availability_id');
    }
}
