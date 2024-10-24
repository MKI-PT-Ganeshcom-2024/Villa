<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenugasanStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penugasan_staff', function (Blueprint $table) {
            $table->id('id_penugasan');
            
            // Foreign key to layanan table (nullable for condition 1)
            $table->foreignId('id_layanan')->nullable()->constrained('layanan', 'id_layanan')->onDelete('set null');
            
            // Foreign key to user table (staff)
            $table->foreignId('id')->constrained('users', 'id')->onDelete('cascade');
            
            // Foreign key to reservasi table (nullable for condition 1)
            $table->foreignId('id_reservasi')->nullable()->constrained('reservasi', 'id_reservasi')->onDelete('cascade');
            
            // Foreign key to kamar table (nullable for condition 2)
            $table->foreignId('id_kamar')->nullable()->constrained('kamar', 'id_kamar')->onDelete('cascade');
            
            // Deskripsi penugasan
            $table->text('deskripsi_penugasan');

            $table->date('tgl_penugasan');
            
            // Status penugasan (enum)
            $table->enum('status_penugasan', ['ditugaskan', 'selesai'])->default('ditugaskan');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penugasan_staff');
    }
}
