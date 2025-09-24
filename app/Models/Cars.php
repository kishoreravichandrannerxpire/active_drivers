<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
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
        return $this->belongsTo(Customers::class, 'customers_id');
    }
    public function histories()
    {
        return $this->hasMany(CarHistory::class, 'cars_id');
    }
}
