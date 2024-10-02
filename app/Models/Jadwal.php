<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = ['ekskul_id', 'hari', 'jam'];

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class);
    }
}
