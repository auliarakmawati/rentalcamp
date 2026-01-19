<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($q = $request->query('q')) {
            $query->where('nama_barang', 'like', '%'.$q.'%');
        }

        $barang = $query->orderByDesc('created_at')->paginate(12);

        return view('user.barang.index', compact('barang'));
    }

    /**
     * tampilkan detail barang untuk user
     */
    public function show($id)
    {
        $item = Barang::where('id_barang', $id)->first();

        if (! $item) {
            abort(404);
        }

        return view('user.barang.show', compact('item'));
    }
}
