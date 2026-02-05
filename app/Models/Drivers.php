<?php

namespace App\Models;   
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    protected $table = 'drivers';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'age',
        'status',
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getEmailAttribute()
    {
        return $this->user->email ?? '';
    }

    public function getMobileNumberAttribute()
    {
        return $this->user->mobile_number ?? '';
    }
    protected static function booted()
    {
        static::created(function ($driver) {
            $driver->histories()->create([
                'user_id'                   => $driver->user_id,
                'first_name'                => $driver->first_name,
                'last_name'                 => $driver->last_name,
                'age'                       => $driver->age,
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
                'user_id'                   => $driver->user_id,
                'first_name'                => $driver->first_name,
                'last_name'                 => $driver->last_name,
                'age'                       => $driver->age,
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
                'user_id'                   => $driver->user_id,
                'first_name'                => $driver->first_name,
                'last_name'                 => $driver->last_name,
                'age'                       => $driver->age,
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