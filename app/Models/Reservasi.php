<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $fillable = [
        'user_id',
        'lapangan_id',
        'kode_booking',
        'tgl_reservasi',
        'slot_jam',
        'total_biaya',
        'status_reservasi',
        'bukti_pembayaran',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }
}
