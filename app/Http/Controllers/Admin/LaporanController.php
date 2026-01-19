<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');
        $bulans    = $request->input('bulan', [date('m')]); // array
        $tahun     = $request->input('tahun', date('Y'));

        // Pastikan $bulans selalu array
        if (!is_array($bulans)) {
            $bulans = [$bulans];
        }

        $query = Penyewaan::with('user');

        // Jika ada range tanggal (Prioritas Utama)
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_sewa', [$startDate, $endDate]);
        } else {
            // Jika filter per bulan & tahun
            $query->whereIn(\DB::raw('MONTH(tanggal_sewa)'), $bulans)
                  ->whereYear('tanggal_sewa', $tahun);
        }

        $laporan = $query->orderBy('tanggal_sewa', 'desc')->get();

        $totalPendapatan = $laporan->sum('total_harga') + $laporan->sum('denda');

        return view('admin.laporan.index', compact('laporan', 'bulans', 'tahun', 'totalPendapatan', 'startDate', 'endDate'));
    }
}
