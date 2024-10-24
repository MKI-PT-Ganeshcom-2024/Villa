<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = [
        'nama_tamu',
        'nomor_ktp',
        'nomor_kamar',
        'nama_staff',
        'tgl_checkin',
        'tgl_checkout',
        'status',
        'dp_pembayaran',
        'total_harga',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'nomor_kamar');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'nama_staff');
    }

    public function layanan()
    {
        return $this->belongsToMany(Layanan::class, 'layanan_reservasi', 'reservasi_id', 'layanan_id');
    }
}
