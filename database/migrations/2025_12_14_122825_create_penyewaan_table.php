<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id('id_penyewaan');

            $table->unsignedBigInteger('id_user');

            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->date('tanggal_dikembalikan')->nullable();

            $table->integer('total_harga')->default(0);
            $table->integer('denda')->default(0);

            $table->enum('status', ['disewa', 'dikembalikan'])
                  ->default('disewa');

            $table->timestamps();

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewaan');
    }
};
