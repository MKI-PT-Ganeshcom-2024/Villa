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
        Schema::create('fasilitas_kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kamar')->constrained('kamar', 'id_kamar')->onDelete('cascade'); // Foreign key ke tabel kamar
            $table->foreignId('id_fasilitas')->constrained('fasilitas', 'id_fasilitas')->onDelete('cascade'); // Foreign key ke tabel fasilitas
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('fasilitas_kamar');
    }
    
};
