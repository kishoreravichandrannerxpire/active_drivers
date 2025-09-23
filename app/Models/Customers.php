<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'mobile_number',
        'password'
    ];
    public function availalabilities()
    {
        return $this->hasMany(CustomerAvailability::class, 'customers_id');
    }
}
