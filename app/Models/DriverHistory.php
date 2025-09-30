<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverHistory extends Model
{
    protected $table = 'drivers_history';
    protected $fillable = [
        'drivers_id',
        'name',
        'age',
        'mobile_number',
        'password',
        'driver_license_number',
        'driver_image',
        'total_experience_years',
        'hill_experience',
        'accident_history',
        'luxury_car_experience',
        'address',
        'pincode',
        'action'
    ];

    public function driver()
    {
        return $this->belongsTo(Drivers::class, 'drivers_id');
    }
}
