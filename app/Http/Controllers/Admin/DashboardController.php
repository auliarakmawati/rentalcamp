<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Barang;
use App\Models\Penyewaan;
use App\Models\Pengembalian;

class DashboardController extends Controller
{
    //hitung ringkasan untuk dashboard
    public function index()
    {
        $totalUser      = User::where('role', 'user')->count();
        $totalBarang    = Barang::count();
        $totalPenyewaan = Penyewaan::count();
        $penyewaanAktif = Penyewaan::where('status', 'disewa')->count();

        // Ambil 5 transaksi terbaru
        $recentTransactions = Penyewaan::with('user')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        // Ambil barang-barang stok rendah (peringatan)
        $lowStockItems = Barang::where('stok', '<', 5)
            ->orderBy('stok', 'asc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalBarang',
            'totalPenyewaan',
            'penyewaanAktif',
            'recentTransactions',
            'lowStockItems'
        ));
    }
}
