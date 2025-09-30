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
        return $this->hasMany(CustomerHistory::class, 'customers_id');
    }

    protected static function booted()
    {
        static::created(function ($customer) {
            $customer->histories()->create([
                'name'            => $customer->name,
                'mobile_number'   => $customer->mobile_number,
                'password'        => $customer->password,
                'action'          => 'created',
            ]);
        });

        static::updated(function ($customer) {
            $customer->histories()->create([
                'name'            => $customer->name,
                'mobile_number'   => $customer->mobile_number,
                'password'        => $customer->password,
                'action'          => 'updated',
            ]);
        });

        static::deleting(function ($customer) {
            $customer->histories()->create([
                'name'            => $customer->name,
                'mobile_number'   => $customer->mobile_number,
                'password'        => $customer->password,
                'action'          => 'deleted',
            ]);
        });
    }
}
