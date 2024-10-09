<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $table = 'ekskul';
    protected $fillable = ['divisi_id', 'name', 'deskripsi', 'lokasi', 'kapasitas', 'jumlah_peserta'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function pembimbing()
{
    return $this->belongsToMany(User::class, 'ekskul_pembimbing', 'ekskul_id', 'pembimbing_id');
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
