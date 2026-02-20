<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name'
    ];

    public function cars()
    {
        return $this->hasMany(Cars::class, 'customers_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getEmailAttribute()
    {
        return $this->user->email ?? '';
    }

    public function getMobileNumberAttribute()
    {
        return $this->user->mobile_number ?? '';
    }

    public function getCarModelAttribute()
    {
        return $this->cars->first()->car_model ?? '';
    }

    public function getCarTypeAttribute()
    {
        return $this->cars->first()->car_type ?? '';
    }

    public function getCarNumberAttribute()
    {
        return $this->cars->first()->car_number ?? '';
    }

    public function getInsuranceAttribute()
    {
        return $this->cars->first()->insurance ?? '';
    }

    public function getFastagAttribute()
    {
        return $this->cars->first()->fastag ?? '';
    }

    public function getTransmissionTypeAttribute()
    {
        return $this->cars->first()->transmission_type ?? '';
    }

    public function getFuelTypeAttribute()
    {
        return $this->cars->first()->fuel_type ?? '';
    }

    public function histories()
    {
        return $this->hasMany(CustomerHistory::class, 'customers_id');
    }

    protected static function booted()
    {
        static::created(function ($customer) {
            $customer->histories()->create([
                'user_id'     => $customer->user_id,
                'first_name'  => $customer->first_name,
                'last_name'   => $customer->last_name,
                'action'      => 'created',
            ]);
        });

        static::updated(function ($customer) {
            $customer->histories()->create([
                'user_id'     => $customer->user_id,
                'first_name'  => $customer->first_name,
                'last_name'   => $customer->last_name,
                'action'      => 'updated',
            ]);
        });

        static::deleting(function ($customer) {
            $customer->histories()->create([
                'user_id'     => $customer->user_id,
                'first_name'  => $customer->first_name,
                'last_name'   => $customer->last_name,
                'action'      => 'deleted',
            ]);
        });
    }

    // public function isProfileComplete()
    // {
    //     if (
    //         empty($this->first_name) ||
    //         empty($this->last_name)
    //     ) {
    //         return false;
    //     }

    //     $car = $this->cars()->first();

    //     if (!$car) {
    //         return false;
    //     }

    //     if (
    //         empty($car->car_model) ||
    //         empty($car->car_type) ||
    //         empty($car->car_number) ||
    //         empty($car->insurance) ||
    //         empty($car->fastag) ||
    //         empty($car->transmission_type) ||
    //         empty($car->fuel_type)
    //     ) {
    //         return false;
    //     }

    //     return true;
    // }
}
