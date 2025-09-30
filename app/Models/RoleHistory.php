<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleHistory extends Model
{
    protected $table = 'roles_history';
    protected $fillable = [
        'roles_id',
        'name',
        'action'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }
}
