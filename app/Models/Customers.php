<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
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
                'first_name'            => $customer->first_name,
                'last_name'             => $customer->last_name,
                'action'                => 'created',
            ]);
        });

        static::updated(function ($customer) {
            $customer->histories()->create([
                'first_name'            => $customer->first_name,
                'last_name'             => $customer->last_name,
                'action'                => 'updated',
            ]);
        });

        static::deleting(function ($customer) {
            $customer->histories()->create([
                'first_name'            => $customer->first_name,
                'last_name'             => $customer->last_name,
                'action'                => 'deleted',
            ]);
        });
    }
}
