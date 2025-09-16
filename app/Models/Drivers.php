<?php

namespace App\Models;   
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    protected $table = 'drivers';
    protected $fillable = [
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
        'pincode'
    ];
    public function availabilities()
    {
        return $this->hasMany(DriverAvailability::class, 'drivers_id');
    }
}
?>