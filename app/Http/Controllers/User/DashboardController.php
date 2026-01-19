<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ambil barang terbaru
        $barang = Barang::orderByDesc('created_at')->get();

        return view('user.dashboard', compact('barang'));
    }
}
