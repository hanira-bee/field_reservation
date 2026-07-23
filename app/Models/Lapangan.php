<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $fillable = [
        'nama_lapangan',
        'jenis_lapangan',
        'lokasi',
        'harga_per_jam',
        'fasilitas',
        'status_aktif',
    ];
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}
