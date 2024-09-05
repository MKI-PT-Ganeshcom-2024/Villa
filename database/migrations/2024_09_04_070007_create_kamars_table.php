<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id('id_kamar');
            $table->integer('nomor_kamar');
            $table->string('foto_kamar')->nullable();
            $table->string('tipe_kamar');
            $table->string('status_kamar');
            $table->integer('kapasitas_kamar');
            $table->decimal('harga_kamar', 10, 2);
            $table->text('fasilitas_kamar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
