<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerHistory extends Model
{
    protected $table = 'customers_history';
    protected $fillable = [
        'customers_id',
        'name',
        'mobile_number',
        'password',
        'action'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customers_id');
    }
}
