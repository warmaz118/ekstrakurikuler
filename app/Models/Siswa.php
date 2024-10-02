<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = ['nis', 'name', 'kelas', 'alamat', 'password', 'role_id', 'divisi_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ekskuls()
    {
        return $this->belongsToMany(Ekskul::class, 'ekskul_siswa');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
