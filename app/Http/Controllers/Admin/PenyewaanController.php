<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use App\Models\PenyewaanDetail;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PenyewaanController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $penyewaan = Penyewaan::with(['user', 'detail.barang'])
            ->when($q, function ($query) use ($q) {
                $query->where('id_penyewaan', $q)
                    ->orWhereHas('user', function ($sub) use ($q) {
                        $sub->where('nama', 'like', "%{$q}%")
                            ->orWhere('email', 'like', "%{$q}%");
                    });
            })
            ->orderByDesc('id_penyewaan')
            ->paginate(20);

        return view('admin.penyewaan.index', compact('penyewaan'));
    }

    public function create()
    {
        return view('admin.penyewaan.create', [
            'users'  => User::orderBy('nama')->get(),
            'barang' => Barang::orderBy('nama_barang')->get()
        ]);
    }

    public function store(Request $request)
    {



        $request->validate([
            'id_user'         => 'required|exists:users,id_user',
            'tanggal_sewa'    => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'barang'          => 'required|array|min:1',
            'barang.*'        => 'exists:barang,id_barang',
            'jumlah'          => 'required|array',
            'jumlah.*'        => 'integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $tglSewa    = new \DateTime($request->tanggal_sewa);
            $tglKembali = new \DateTime($request->tanggal_kembali);
            
            // Hitung durasi inklusif (tanggal sewa sampai kembali dihitung penuh)
            $diff       = $tglSewa->diff($tglKembali);
            $durasi     = $diff->days + 1;

            $penyewaan = Penyewaan::create([
                'id_user'         => $request->id_user,
                'tanggal_sewa'    => $request->tanggal_sewa,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status'          => 'disewa',
                'total_harga'     => 0,
                'denda'           => 0,
            ]);

            $totalHarga = 0;

            foreach ($request->barang as $key => $idBarang) {
                if (!$idBarang) continue;

                $qty = (int) $request->jumlah[$key];
                $barang = Barang::where('id_barang', $idBarang)->lockForUpdate()->first();

                if (! $barang) {
                    throw new \Exception("Barang dengan id {$idBarang} tidak ditemukan.");
                }

                if ($barang->stok < $qty) {
                    throw new \Exception("Stok {$barang->nama_barang} tidak cukup");
                }

                $subtotal = $barang->harga_sewa * $qty * $durasi;
                $totalHarga += $subtotal;

                PenyewaanDetail::create([
                    'id_penyewaan' => $penyewaan->id_penyewaan,
                    'id_barang'    => $barang->id_barang,
                    'jumlah'       => $qty,
                    'subtotal'     => $subtotal,
                ]);

                $barang->decrement('stok', $qty);
            }

            $penyewaan->update(['total_harga' => $totalHarga]);




            DB::commit();

            return redirect()
                ->route('admin.pembayaran.create', $penyewaan->id_penyewaan)
                ->with('success', 'Penyewaan berhasil dibuat. Silakan lakukan pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $penyewaan = Penyewaan::with(['user', 'pembayaran', 'pengembalian', 'detail.barang'])->findOrFail($id);

        return view('admin.penyewaan.show', compact('penyewaan'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $penyewaan = Penyewaan::with('detail')->lockForUpdate()->findOrFail($id);

            if ($penyewaan->status == 'disewa') {
                foreach ($penyewaan->detail as $detail) {
                    $barang = Barang::where('id_barang', $detail->id_barang)->lockForUpdate()->first();
                    if ($barang) {
                        $barang->increment('stok', $detail->jumlah);
                    }
                }
            }

            $penyewaan->delete();
            DB::commit();

            return redirect()->route('admin.penyewaan.index')->with('success', 'Penyewaan berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
