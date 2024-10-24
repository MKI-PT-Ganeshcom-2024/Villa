<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id('id_reservasi');
            $table->string('nama_tamu');
            $table->bigInteger('nomor_ktp');
            $table->foreignId('nomor_kamar')->constrained('kamar', 'id_kamar')->onDelete('cascade');
            $table->foreignId('nama_staff')->constrained('users', 'id')->onDelete('cascade');
            $table->date('tgl_checkin');
            $table->date('tgl_checkout');
            $table->enum('status', ['konfirmasi', 'check in', 'check out'])->default('konfirmasi');
            $table->decimal('dp_pembayaran', 10, 2);
            $table->decimal('total_harga', 10, 2);
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
        Schema::dropIfExists('reservasi');
    }
}
