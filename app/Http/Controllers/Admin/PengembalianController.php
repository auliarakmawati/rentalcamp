<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use App\Models\Pengembalian;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $query = Penyewaan::with('user')->where('status', 'disewa');

        if ($q = $request->query('q')) {
            $query->whereHas('user', function ($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%");
            })->orWhere('id_penyewaan', $q);
        }

        $penyewaan = $query->orderBy('tanggal_kembali', 'asc')->paginate(10);

        return view('admin.pengembalian.index', compact('penyewaan'));
    }

    public function show($id)
    {
        $penyewaan = Penyewaan::with(['user', 'detail.barang', 'pengembalian'])->findOrFail($id);

        $items = $penyewaan->detail->map(function ($detail) {
            return [
                'nama_barang' => $detail->barang->nama_barang,
                'foto' => $detail->barang->foto,
                'jumlah' => $detail->jumlah,
                'subtotal' => $detail->subtotal,
            ];
        });

        return view('admin.pengembalian.show', compact('penyewaan', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penyewaan'         => 'required|exists:penyewaan,id_penyewaan',
            'tanggal_dikembalikan' => 'required|date',
            'kondisi_barang'       => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $penyewaan = Penyewaan::with('detail')->lockForUpdate()->findOrFail($request->id_penyewaan);

            if ($penyewaan->status !== 'disewa') {
                throw new \Exception('Penyewaan ini sudah diproses pengembaliannya.');
            }

            if ($penyewaan->pengembalian) {
                throw new \Exception('Pengembalian untuk penyewaan ini sudah tercatat.');
            }

            // Gunakan DateTime native PHP
            $due = new \DateTime($penyewaan->tanggal_kembali);
            $due->setTime(0, 0, 0);

            $actual = new \DateTime($request->tanggal_dikembalikan);
            $actual->setTime(0, 0, 0);

            // Hitung selisih hari
            // diff mengembalikan DateInterval. %r%a akan menghasilkan signed integer hari.
            $interval = $due->diff($actual);
            $hariTelat = (int) $interval->format('%r%a');

            $totalDenda = 0;

            if ($hariTelat > 0) {
                $totalDenda = $hariTelat * 3000;
            }

            foreach ($penyewaan->detail as $detail) {
                $barang = Barang::where('id_barang', $detail->id_barang)->lockForUpdate()->first();
                if ($barang) {
                    $barang->increment('stok', $detail->jumlah);
                }
            }

            $pengembalian = Pengembalian::create([
                'id_penyewaan'           => $penyewaan->id_penyewaan,
                'tanggal_dikembalikan'   => $actual->format('Y-m-d H:i:s'),
                'kondisi_barang'         => $request->kondisi_barang,
                'denda'                  => $totalDenda,
            ]);

            $penyewaan->update([
                'tanggal_dikembalikan' => $actual->format('Y-m-d H:i:s'),
                'denda'               => $totalDenda,
                'status'              => 'dikembalikan',
            ]);

            DB::commit();

            return redirect()->route('admin.pengembalian.receipt', $pengembalian->id_pengembalian)
                ->with('success', 'Pengembalian berhasil dicatat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function receipt($id)
    {
        $pengembalian = Pengembalian::with(['penyewaan.user', 'penyewaan.detail.barang'])->findOrFail($id);

        return view('admin.pengembalian.receipt', compact('pengembalian'));
    }
}
