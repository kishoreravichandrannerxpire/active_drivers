<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'users';
    protected $fillable = [
        'id',
        'roles_id',
        'email',
        'mobile_number',
        'password'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }
      public function histories()
    {
        return $this->hasMany(UserHistory::class, 'users_id');
    }
    public function customer()
    {
        return $this->hasOne(Customers::class, 'user_id');
    }

    // public function isProfileComplete()
    // {
    //     if ($this->role && $this->role->role_name === 'Customer') {
    //         return $this->customer?->isProfileComplete() ?? false;
    //     }

    //     if ($this->role && $this->role->role_name === 'Driver') {
    //         return $this->driver?->isProfileComplete() ?? false;
    //     }

    //     return false;
    // }
 
    protected static function booted()
    {
        static::created(function ($user) {
            $user->histories()->create([
                'roles_id'       => $user->roles_id,
                'email'          => $user->email,
                'mobile_number'  => $user->mobile_number,
                'password'       => $user->password,
                'action'         => 'created',
            ]);
        });
 
        static::updated(function ($user) {
            $user->histories()->create([
                'roles_id'       => $user->roles_id,
                'email'          => $user->email,
                'mobile_number'  => $user->mobile_number,
                'password'       => $user->password,
                'action'         => 'updated',
            ]);
        });
 
        static::deleting(function ($user) {
            $user->histories()->create([
                'roles_id'       => $user->roles_id,
                'email'          => $user->email,
                'mobile_number'  => $user->mobile_number,
                'password'       => $user->password,
                'action'         => 'deleted',
            ]);
        });
    }
}
?>