<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $fillable = ['divisi_id', 'name', 'hari', 'jam', 'lokasi'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function pembimbing()
    {
        return $this->belongsToMany(User::class, 'ekskul_pembimbing');
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'ekskul_siswa');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
