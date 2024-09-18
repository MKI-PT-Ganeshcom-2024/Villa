<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar'; // Nama tabel

    protected $primaryKey = 'id_kamar'; // Primary key

    protected $fillable = [
        'foto_kamar',
        'nomor_kamar',
        'tipe_kamar',
        'harga_kamar',
        'status_kamar',
        'kapasitas_kamar',
    ];

    /**
     * Relasi Many-to-Many dengan model Fasilitas
     * Satu kamar bisa memiliki banyak fasilitas
     */
    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_kamar', 'id_kamar', 'id_fasilitas');
    }
}
