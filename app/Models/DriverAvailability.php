<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DriverAvailability extends Model
{
    protected $table = 'driver_availability';
    protected $fillable = [
        'drivers_id',
        'from_date_time',
        'to_date_time',
        'status'
    ];
    public function driver()
    {
        return $this->belongsTo(Drivers::class, 'drivers_id');
    }
    public function histories()
    {
        return $this->hasMany(DriverAvailabilityHistory::class, 'driver_availability_id');
    }
    protected static function booted()
    {
        static::created(function ($availability) {
            $availability->histories()->create([
                'drivers_id'      => $availability->drivers_id,
                'from_date_time'  => $availability->from_date_time,
                'to_date_time'    => $availability->to_date_time,
                'status'          => $availability->status,
                'action'          => 'created',
            ]);
        });

        static::updated(function ($availability) {
            $availability->histories()->create([
                'drivers_id'      => $availability->drivers_id,
                'from_date_time'  => $availability->from_date_time,
                'to_date_time'    => $availability->to_date_time,
                'status'          => $availability->status,
                'action'          => 'updated',
            ]);
        });

        static::deleting(function ($availability) {
            $availability->histories()->create([
                'drivers_id'      => $availability->drivers_id,
                'from_date_time'  => $availability->from_date_time,
                'to_date_time'    => $availability->to_date_time,
                'status'          => $availability->status,
                'action'          => 'deleted',
            ]);
        });
    }
}
?>