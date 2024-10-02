<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanFoto extends Model
{
    protected $fillable = ['laporan_id', 'path'];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}
