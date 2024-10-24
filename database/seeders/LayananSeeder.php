<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('layanan')->insert([
            [
                'kategori_layanan' => 'Kesehatan',
                'nama_layanan' => 'Pijat Relaksasi',
                'harga_layanan' => 150000,
                'deskripsi_layanan' => 'Pijat untuk relaksasi otot dan meningkatkan sirkulasi darah.',
                'status_layanan' => 'Aktif',
            ],
            [
                'kategori_layanan' => 'Makanan',
                'nama_layanan' => 'Sarapan Spesial',
                'harga_layanan' => 50000,
                'deskripsi_layanan' => 'Sarapan dengan berbagai pilihan menu sehat.',
                'status_layanan' => 'Aktif',
            ],
            [
                'kategori_layanan' => 'Transportasi',
                'nama_layanan' => 'Antar Jemput Bandara',
                'harga_layanan' => 300000,
                'deskripsi_layanan' => 'Layanan antar jemput ke bandara.',
                'status_layanan' => 'Aktif',
            ],
            [
                'kategori_layanan' => 'Olahraga',
                'nama_layanan' => 'Sewa Sepeda',
                'harga_layanan' => 20000,
                'deskripsi_layanan' => 'Sewa sepeda untuk berkeliling.',
                'status_layanan' => 'Aktif',
            ],
        ]);
    }
}
