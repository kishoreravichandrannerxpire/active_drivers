<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DriverAvailability extends Model
{
    protected $table = 'driver_availability';
    protected $fillable = [
        'drivers_id',
        'available_date',
        'start_time',
        'end_time',
        'status'
    ];
    public function driver()
    {
        return $this->belongsTo(Drivers::class, 'drivers_id');
    }
}
?>