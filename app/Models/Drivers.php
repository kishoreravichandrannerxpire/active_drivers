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
    public function histories()
    {
        return $this->hasMany(DriverHistory::class, 'drivers_id');
    }
    protected static function booted()
    {
        static::created(function ($driver) {
            $driver->histories()->create([
                'name'                      => $driver->name,
                'age'                       => $driver->age,
                'mobile_number'             => $driver->mobile_number,
                'password'                  => $driver->password,
                'driver_license_number'     => $driver->driver_license_number,
                'driver_image'              => $driver->driver_image,
                'total_experience_years'    => $driver->total_experience_years,
                'hill_experience'           => $driver->hill_experience,
                'accident_history'          => $driver->accident_history,
                'luxury_car_experience'     => $driver->luxury_car_experience,
                'address'                   => $driver->address,
                'pincode'                   => $driver->pincode,
                'action'                    => 'created',
            ]);
        });

        static::updated(function ($driver) {
            $driver->histories()->create([
                'name'                      => $driver->name,
                'age'                       => $driver->age,
                'mobile_number'             => $driver->mobile_number,
                'password'                  => $driver->password,
                'driver_license_number'     => $driver->driver_license_number,
                'driver_image'              => $driver->driver_image,
                'total_experience_years'    => $driver->total_experience_years,
                'hill_experience'           => $driver->hill_experience,
                'accident_history'          => $driver->accident_history,
                'luxury_car_experience'     => $driver->luxury_car_experience,
                'address'                   => $driver->address,
                'pincode'                   => $driver->pincode,
                'action'                    => 'updated',
            ]);
        });

        static::deleting(function ($driver) {
            $driver->histories()->create([
                'name'                      => $driver->name,
                'age'                       => $driver->age,
                'mobile_number'             => $driver->mobile_number,
                'password'                  => $driver->password,
                'driver_license_number'     => $driver->driver_license_number,
                'driver_image'              => $driver->driver_image,
                'total_experience_years'    => $driver->total_experience_years,
                'hill_experience'           => $driver->hill_experience,
                'accident_history'          => $driver->accident_history,
                'luxury_car_experience'     => $driver->luxury_car_experience,
                'address'                   => $driver->address,
                'pincode'                   => $driver->pincode,
                'action'                    => 'deleted',
            ]);
        });
    }
}
?>