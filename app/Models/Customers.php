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

    public function cars()
    {
        return $this->hasMany(Cars::class, 'customers_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'customers_id');
    }
}
