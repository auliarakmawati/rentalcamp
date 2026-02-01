<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

   public function up(): void
{
    Schema::create('barang', function (Blueprint $table) {
        $table->id('id_barang');
        $table->string('nama_barang');
        $table->text('deskripsi')->nullable();
        $table->integer('harga_sewa');
        $table->integer('stok');
        $table->string('foto')->nullable();
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
