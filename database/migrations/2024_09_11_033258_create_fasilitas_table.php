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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id('id_fasilitas'); // Primary Key
            $table->string('nama_fasilitas', 45); // Nama Fasilitas (varchar 45)
            $table->timestamps(); // Created at & Updated at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('fasilitas');
    }
    
};
