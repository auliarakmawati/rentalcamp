<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penyewaan;
use App\Models\PenyewaanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $pembayaran = Pembayaran::with('penyewaan.user')
            ->when($q, function ($query) use ($q) {
                $query->whereHas('penyewaan.user', function ($sub) use ($q) {
                    $sub->where('nama', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id_pembayaran')
            ->paginate(20);

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function create($id_penyewaan)
    {
        $penyewaan = Penyewaan::with('user')->findOrFail($id_penyewaan);

        $detail = PenyewaanDetail::with('barang')
            ->where('id_penyewaan', $id_penyewaan)
            ->get();

        return view('admin.pembayaran.create', compact('penyewaan', 'detail'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penyewaan' => 'required|exists:penyewaan,id_penyewaan',
            'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $penyewaan = Penyewaan::findOrFail($request->id_penyewaan);

            // simpan pembayaran
            $pembayaran = Pembayaran::create([
                'id_penyewaan' => $penyewaan->id_penyewaan,
                'jumlah_bayar' => $request->jumlah_bayar,
                'metode'       => 'tunai', 
                'tanggal_bayar'=> now()->toDateString(),
            ]);

            DB::commit();

            return redirect()
                ->route('admin.pembayaran.show', $pembayaran->id_pembayaran)
                ->with('success', 'Pembayaran berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with([
            'penyewaan.user',
            'penyewaan.detail.barang'
        ])->findOrFail($id);

        return view('admin.pembayaran.show', compact('pembayaran'));
    }
}
