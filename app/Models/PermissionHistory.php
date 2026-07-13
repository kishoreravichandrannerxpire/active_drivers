<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionHistory extends Model
{
    protected $table = 'permissions_history';
    protected $fillable = [
        'roles_id',
        'permission',
        'module',
        'effect',
        'action'
    ];
    public function permission()
    {
        return $this->BelongsTo(Permission::class, 'permissions_id');
    }
}
