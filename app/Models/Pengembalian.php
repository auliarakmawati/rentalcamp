<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';

    protected $fillable = [
        'id_penyewaan',
        'tanggal_dikembalikan',
        'kondisi_barang',
        'denda'
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'id_penyewaan');
    }
}
