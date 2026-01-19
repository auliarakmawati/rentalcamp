<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTanggalKembaliOnPengembalian extends Migration
{
    public function up()
    {
        Schema::table('pengembalian', function (Blueprint $table) {
            $table->renameColumn('tanggal_kembali', 'tanggal_dikembalikan');
        });
    }

    public function down()
    {
        Schema::table('pengembalian', function (Blueprint $table) {
            $table->renameColumn('tanggal_dikembalikan', 'tanggal_kembali');
        });
    }
}
