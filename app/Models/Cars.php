<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cars extends Model
{
    use SoftDeletes;
    protected $table = 'cars';
    protected $fillable = [
        'customers_id',
        'car_model',
        'car_type',
        'car_number',
        'insurance',
        'fastag',
        'transmission_type',
        'fuel_type'
    ];
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customers_id')->withTrashed();
    }
    public function histories()
    {
        return $this->hasMany(CarHistory::class, 'cars_id');
    }

    protected static function booted()
    {
        static::created(function ($car) {
            $car->histories()->create([
                'car_model'         => $car->car_model,
                'car_type'          => $car->car_type,
                'car_number'        => $car->car_number,
                'insurance'         => $car->insurance,
                'fastag'           => $car->fastag,
                'transmission_type' => $car->transmission_type,
                'fuel_type'         => $car->fuel_type,
                'action'            => 'created',
            ]);
        });

        static::updated(function ($car) {
            $car->histories()->create([
                'car_model'         => $car->car_model,
                'car_type'          => $car->car_type,
                'car_number'        => $car->car_number,
                'insurance'         => $car->insurance,
                'fastag'           => $car->fastag,
                'transmission_type' => $car->transmission_type,
                'fuel_type'         => $car->fuel_type,
                'action'            => 'updated',
            ]);
        });

        static::deleting(function ($car) {
            $car->histories()->create([
                'car_model'         => $car->car_model,
                'car_type'          => $car->car_type,
                'car_number'        => $car->car_number,
                'insurance'         => $car->insurance,
                'fastag'           => $car->fastag,
                'transmission_type' => $car->transmission_type,
                'fuel_type'         => $car->fuel_type,
                'action'            => 'deleted',
            ]);
        });
    }
}
