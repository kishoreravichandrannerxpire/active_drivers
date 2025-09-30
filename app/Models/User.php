<?php


namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = [
        'id',
        'roles_id',
        'name',
        'email',
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
                'name'           => $user->name,
                'email'          => $user->email,
                'password'       => $user->password,
                'action'         => 'created',
            ]);
        });
 
        static::updated(function ($user) {
            $user->histories()->create([
                'roles_id'       => $user->roles_id,
                'name'           => $user->name,
                'email'          => $user->email,
                'password'       => $user->password,
                'action'         => 'updated',
            ]);
        });
 
        static::deleting(function ($user) {
            $user->histories()->create([
                'roles_id'       => $user->roles_id,
                'name'           => $user->name,
                'email'          => $user->email,
                'password'       => $user->password,
                'action'         => 'deleted',
            ]);
        });
    }
}
?>