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
        'deskripsi',
        'fasilitas',
        'ukuran',
        'gambar',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}
