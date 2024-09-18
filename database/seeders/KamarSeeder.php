<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar; // Pastikan model Kamar ada
use App\Models\Fasilitas;

class KamarSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan data kamar
        $kamar1 = Kamar::create([
            'nomor_kamar' => '101',
            'tipe_kamar' => 'Deluxe',
            'status_kamar' => 'Tersedia',
            'kapasitas_kamar' => 2,
            'harga_kamar' => 500000,
            'foto_kamar' => null, // Sesuaikan jika Anda memiliki file foto
        ]);

        $kamar2 = Kamar::create([
            'nomor_kamar' => '102',
            'tipe_kamar' => 'Suite',
            'status_kamar' => 'Tersedia',
            'kapasitas_kamar' => 4,
            'harga_kamar' => 1000000,
            'foto_kamar' => null, // Sesuaikan jika Anda memiliki file foto
        ]);

        
    }
}
