<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisi';
    protected $fillable = ['nama'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_divisi');
    }

    public function ekskuls()
    {
        return $this->hasMany(Ekskul::class);
    }
}
