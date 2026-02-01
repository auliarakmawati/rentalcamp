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
    public function getSedangDisewaAttribute()
    {
        return $this->penyewaanDetail()
            ->whereHas('penyewaan', function($q){
                $q->where('status', 'disewa');
            })
            ->sum('jumlah');
    }

    public function getTotalStokAttribute()
    {
        return $this->stok + $this->sedang_disewa;
    }
}

