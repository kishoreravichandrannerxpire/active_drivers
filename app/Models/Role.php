<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'id',
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'roles_id');
    }   

    public function histories()
    {
        return $this->hasMany(RoleHistory::class, 'roles_id');
    }

    protected static function booted()
    {
        static::created(function ($role) {
            $role->histories()->create([
                'name'   => $role->name,
                'action' => 'created',
            ]);
        });

        static::updated(function ($role) {
            $role->histories()->create([
                'name'   => $role->name,
                'action' => 'updated',
            ]);
        });

        static::deleting(function ($role) {
            $role->histories()->create([
                'name'   => $role->name,
                'action' => 'deleted',
            ]);
        });
    }
}
