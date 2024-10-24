<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    protected $fillable = [
        'kategori_layanan',
        'nama_layanan',
        'harga_layanan',
        'deskripsi_layanan',
        'status_layanan',
    ];

    public function reservasi()
    {
        return $this->belongsToMany(Reservasi::class, 'layanan_reservasi', 'layanan_id', 'reservasi_id');
    }
}
