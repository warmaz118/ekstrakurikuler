<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'isactive',
    ];

    protected $casts = [
        'isactive' => 'boolean',
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
