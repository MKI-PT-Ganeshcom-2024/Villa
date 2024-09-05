<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';
    protected $primaryKey = 'id_kamar';

    protected $fillable = [
        'nomor_kamar',
        'foto_kamar',
        'tipe_kamar',
        'status_kamar',
        'kapasitas_kamar',
        'harga_kamar',
        'fasilitas_kamar',
    ];
}
