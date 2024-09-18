<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id('id_kamar'); // Primary Key
            // $table->foreignId('id_fasilitas')->constrained('fasilitas', 'id_fasilitas')->onDelete('cascade'); // Merujuk ke id_fasilitas
            $table->string('foto_kamar', 2048)->nullable(); // Foto Kamar (nullable)
            $table->string('nomor_kamar', 50); // Nomor Kamar (varchar 50)
            $table->string('tipe_kamar', 50); // Tipe Kamar (varchar 50)
            $table->decimal('harga_kamar', 10, 2); // Harga Kamar (decimal 10,2)
            $table->enum('status_kamar', ['Tersedia', 'Booked']); // Status Kamar (enum)
            $table->integer('kapasitas_kamar'); // Kapasitas Kamar (int)
            $table->timestamps(); // Created at & Updated at
        });
    }
    
    
    public function down()
    {
        Schema::dropIfExists('kamar');
    }
    
};
