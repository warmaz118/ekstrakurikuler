<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = ['ekskul_id', 'siswa_id', 'keterangan'];

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function fotos()
    {
        return $this->hasMany(LaporanFoto::class);
    }
}
