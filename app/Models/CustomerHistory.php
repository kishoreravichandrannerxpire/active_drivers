<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerHistory extends Model
{
    protected $table = 'customers_history';
    protected $fillable = [
        'customers_id',
        'user_id',
        'first_name',
        'last_name',
        'action'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customers_id');
    }
}
