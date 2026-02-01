<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penyewaan', function (Blueprint $table) {
            $table->id('id_detail_penyewaan');

            $table->unsignedBigInteger('id_penyewaan');
            $table->unsignedBigInteger('id_barang');

            $table->integer('jumlah');
            $table->integer('harga_sewa');
            $table->integer('subtotal');
            $table->integer('denda_per_barang')->default(0);

            $table->timestamps();

            $table->foreign('id_penyewaan')
                  ->references('id_penyewaan')
                  ->on('penyewaan')
                  ->onDelete('cascade');

            $table->foreign('id_barang')
                  ->references('id_barang')
                  ->on('barang')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penyewaan');
    }
};
