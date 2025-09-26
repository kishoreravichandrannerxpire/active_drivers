<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = [
        'customers_id',
        'drivers_id',
        'journey_type',
        'pickup_location',
        'drop_location',
        'from_postcode',
        'to_postcode',
        'pickup_date_time',
        'passengers',
        'cars_id',
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customers_id');
    }
    public function driver()
    {
        return $this->belongsTo(Drivers::class, 'drivers_id');
    }
    public function car()
    {
        return $this->belongsTo(Cars::class, 'cars_id');
    }

}
