<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas; // Pastikan model Fasilitas ada

class FasilitasSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan data fasilitas
        Fasilitas::create(['nama_fasilitas' => 'WiFi']);
        Fasilitas::create(['nama_fasilitas' => 'Kolam Renang']);
        Fasilitas::create(['nama_fasilitas' => 'Sarapan']);
        Fasilitas::create(['nama_fasilitas' => 'AC']);
        Fasilitas::create(['nama_fasilitas' => 'Televisi']);
    }
}
