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

    public function histories()
    {
        return $this->hasMany(BookingHistory::class, 'bookings_id');
    }

    protected static function booted()
    {
        static::created(function ($booking) {
            $booking->histories()->create([
                'customers_id'      => $booking->customers_id,
                'drivers_id'        => $booking->drivers_id,
                'journey_type'      => $booking->journey_type,
                'pickup_location'   => $booking->pickup_location,
                'drop_location'     => $booking->drop_location,
                'from_postcode'     => $booking->from_postcode,
                'to_postcode'       => $booking->to_postcode,
                'pickup_date_time'  => $booking->pickup_date_time,
                'passengers'        => $booking->passengers,
                'cars_id'           => $booking->cars_id,
                'action'            => 'created',
            ]);
        });

        static::updated(function ($booking) {
            $booking->histories()->create([
                'customers_id'      => $booking->customers_id,
                'drivers_id'        => $booking->drivers_id,
                'journey_type'      => $booking->journey_type,
                'pickup_location'   => $booking->pickup_location,
                'drop_location'     => $booking->drop_location,
                'from_postcode'     => $booking->from_postcode,
                'to_postcode'       => $booking->to_postcode,
                'pickup_date_time'  => $booking->pickup_date_time,
                'passengers'        => $booking->passengers,
                'cars_id'           => $booking->cars_id,
                'action'            => 'updated',
            ]);
        });

        static::deleting(function ($booking) {
            $booking->histories()->create([
                'customers_id'      => $booking->customers_id,
                'drivers_id'        => $booking->drivers_id,
                'journey_type'      => $booking->journey_type,
                'pickup_location'   => $booking->pickup_location,
                'drop_location'     => $booking->drop_location,
                'from_postcode'     => $booking->from_postcode,
                'to_postcode'       => $booking->to_postcode,
                'pickup_date_time'  => $booking->pickup_date_time,
                'passengers'        => $booking->passengers,
                'cars_id'           => $booking->cars_id,
                'action'            => 'deleted',
            ]);
        });
    }

}
