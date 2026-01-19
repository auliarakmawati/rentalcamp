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
    Schema::create('pembayaran', function (Blueprint $table) {
        $table->id('id_pembayaran');
        $table->unsignedBigInteger('id_penyewaan');
        $table->integer('jumlah_bayar');
        $table->string('metode'); // transfer, cod, qris, dll
        $table->date('tanggal_bayar');
        $table->string('kode_qr')->nullable(); // untuk menyimpan nama file QR
        $table->timestamps();

        $table->foreign('id_penyewaan')
              ->references('id_penyewaan')
              ->on('penyewaan')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
