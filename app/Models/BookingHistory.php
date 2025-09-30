<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    protected $table = 'bookings_history';
    protected $fillable = [
        'bookings_id',
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
        'action'
    ];

    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'bookings_id');
    }
}
