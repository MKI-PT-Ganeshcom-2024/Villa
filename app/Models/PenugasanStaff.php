<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanStaff extends Model
{
    use HasFactory;
    protected $table = 'penugasan_staff';
    protected $primaryKey = 'id_penugasan';

    protected $fillable = [
        'id_layanan',
        'id',
        'id_reservasi',
        'id_kamar',
        'deskripsi_penugasan',
        'tgl_penugasan',
        'status_penugasan',
    ];

    // Relationship with Layanan (nullable)
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }

    // Relationship with User (staff)
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relationship with Reservasi (nullable)
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }

    // Relationship with Kamar (nullable)
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }
}
