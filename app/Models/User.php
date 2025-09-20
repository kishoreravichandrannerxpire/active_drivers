<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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
}
?>