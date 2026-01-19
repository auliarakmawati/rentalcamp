<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penyewaan extends Model
{
    use HasFactory;

    protected $table = 'penyewaan';
    protected $primaryKey = 'id_penyewaan';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user',
        'tanggal_sewa',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'total_harga',
        'denda',
        'status',
    ];
    
    // penyewaan -> user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // penyewaan -> detail_penyewaan
    public function detail()
    {
        return $this->hasMany(PenyewaanDetail::class, 'id_penyewaan', 'id_penyewaan');
    }

    // penyewaan -> pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_penyewaan', 'id_penyewaan');
    }

    // penyewaan -> pengembalian
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_penyewaan', 'id_penyewaan');
    }
}
