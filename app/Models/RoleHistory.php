<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleHistory extends Model
{
    protected $table = 'roles_history';
    protected $fillable = [
        'roles_id',
        'role_name',
        'action'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }
}
