<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_buku');
            $table->string('judul');            
            $table->integer('tahun_terbit');
            $table->integer('jumlah');
            $table->foreignId('pengarang_id');
            $table->foreignId('penerbit_id');             
            $table->foreignId('rak_kode_rak');            
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
        Schema::dropIfExists('bukus');
    }
};
