<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function divisi()
    {
        return $this->belongsToMany(Divisi::class, 'user_divisi');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
}
