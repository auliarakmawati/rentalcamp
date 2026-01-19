<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'harga_sewa',
        'stok',
        'foto',
    ];
    public function penyewaanDetail()
    {
        return $this->hasMany(PenyewaanDetail::class, 'id_barang');
    }

    // hitung berapa unit yang sedang berada di tangan penyewa
    public function getSedangDisewaAttribute()
    {
        return $this->penyewaanDetail()
            ->whereHas('penyewaan', function($q){
                $q->where('status', 'disewa');
            })
            ->sum('jumlah');
    }

    // hitung total barang yang dimiliki (Tersedia + Disewa)
    public function getTotalStokAttribute()
    {
        return $this->stok + $this->sedang_disewa;
    }
}

