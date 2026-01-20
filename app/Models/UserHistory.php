<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    protected $table = 'users_history';
    protected $fillable = [
        'users_id',
        'roles_id',
        'email',
        'mobile_number',
        'password',
        'action'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
