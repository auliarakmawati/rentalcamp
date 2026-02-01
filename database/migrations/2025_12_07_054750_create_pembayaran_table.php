<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('pembayaran', function (Blueprint $table) {
        $table->id('id_pembayaran');
        $table->unsignedBigInteger('id_penyewaan');
        $table->integer('jumlah_bayar');
        $table->string('metode');
        $table->date('tanggal_bayar');
        $table->string('kode_qr')->nullable();
        $table->timestamps();

        $table->foreign('id_penyewaan')
              ->references('id_penyewaan')
              ->on('penyewaan')
              ->onDelete('cascade');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
