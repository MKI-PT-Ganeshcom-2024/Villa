<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas'; // Nama tabel

    protected $primaryKey = 'id_fasilitas'; // Primary key

    protected $fillable = [
        'nama_fasilitas', // Kolom yang bisa diisi
    ];

    /**
     * Relasi Many-to-Many dengan model Kamar
     * Satu fasilitas bisa dimiliki oleh banyak kamar
     */
    public function kamar()
    {
        return $this->belongsToMany(Kamar::class, 'fasilitas_kamar', 'id_fasilitas', 'id_kamar');
    }
}
