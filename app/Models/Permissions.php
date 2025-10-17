<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'roles_id',
        'permission',
        'module',
        'effect',
    ];
    public function permission()
    {
        return $this->BelongsTo(Role::class, 'roles_id');
    }
    public function histories()
    {
        return $this->hasMany(PermissionHistory::class, 'permissions_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id','id');
    }

    protected static function booted()
    {
        static::created(function($permissions) {
            $permissions->histories()->create([
                'roles_id' => $permissions->roles_id,
                'permission' => $permissions->permission,
                'module' => $permissions->module,
                'effect' => $permissions->effect,
                'action' => 'created',
            ]);
        });
        static::updated(function($permissions) {
            $permissions->histories()->create([
                'roles_id' => $permissions->roles_id,
                'permission' => $permissions->permission,
                'module' => $permissions->module,
                'effect' => $permissions->effect,
                'action' => 'updated',
            ]);
        });
        static::deleting(function($permissions) {
            $permissions->histories()->create([
                'roles_id' => $permissions->roles_id,
                'permission' => $permissions->permission,
                'module' => $permissions->module,
                'effect' => $permissions->effect,
                'action' => 'deleted',
            ]);
        });
    }
}
