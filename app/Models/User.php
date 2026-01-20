<?php


namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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