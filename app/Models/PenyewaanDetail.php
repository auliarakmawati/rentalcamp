<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyewaanDetail extends Model
{
    protected $table = 'penyewaan_detail';
    protected $primaryKey = 'id_penyewaan_detail';

    protected $fillable = [
        'id_penyewaan',
        'id_barang',
        'jumlah',
        'subtotal',
    ];

    // detail -> barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    // detail -> penyewaan
    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'id_penyewaan');
    }
}
