<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarHistory extends Model
{
    protected $table = 'cars_history';
    protected $fillable = [
        'cars_id',
        'car_model',
        'car_type',
        'car_number',
        'insurance',
        'fastag',
        'transmission_type',
        'fuel_type',
        'action'
    ];

    public function car()
    {
        return $this->belongsTo(Cars::class, 'cars_id');
    }
}
