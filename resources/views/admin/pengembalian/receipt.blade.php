@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <div>
            <h4 class="fw-bold mb-0">Nota Pengembalian</h4>
            <small class="text-muted">Bukti pengembalian barang rental</small>
        </div>
        <div>
            <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button class="btn btn-primary" onclick="window.print()">
                <i class="bi bi-printer-fill me-1"></i> Cetak Nota
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body p-5">

            <div class="text-center mb-4">
                <h3 class="fw-bold text-uppercase mb-1">GearLeaf | Rental Camp</h3>
                <small class="text-muted d-block">Rental & Outdoor Equipment</small>
                <small class="text-muted">Telp: 0857-0676-0096</small>
            </div>

            <div class="text-center mb-4">
                <span class="badge bg-success px-4 py-2 fs-6">NOTA PENGEMBALIAN</span>
            </div>

            <hr class="my-4">

            <div class="row mb-3">
                <div class="col-6">
                    <small class="text-muted d-block">NO. PENGEMBALIAN</small>
                    <span class="fw-bold">#RTN-{{ str_pad($pengembalian->id_pengembalian, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="col-6 text-end">
                    <small class="text-muted d-block">TANGGAL KEMBALI</small>
                    <span class="fw-bold">
                        {{ \Carbon\Carbon::parse($pengembalian->tanggal_dikembalikan)->format('d/m/Y') }}
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <small class="text-muted d-block">PENYEWA</small>
                    <span class="fw-bold">{{ $pengembalian->penyewaan->user->nama }}</span>
                </div>
                <div class="col-6 text-end">
                    <small class="text-muted d-block">NO. PENYEWAAN</small>
                    <span class="fw-bold">#{{ $pengembalian->penyewaan->id_penyewaan }}</span>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-6">
                    <small class="text-muted d-block">TGL SEWA</small>
                    <span>{{ \Carbon\Carbon::parse($pengembalian->penyewaan->tanggal_sewa)->format('d/m/Y') }}</span>
                </div>
                <div class="col-6 text-end">
                    <small class="text-muted d-block">JATUH TEMPO</small>
                    <span>{{ \Carbon\Carbon::parse($pengembalian->penyewaan->tanggal_kembali)->format('d/m/Y') }}</span>
                </div>
            </div>

            <table class="table table-sm table-borderless mb-4">
                <thead class="border-bottom">
                    <tr class="text-muted small">
                        <th>ITEM</th>
                        <th class="text-center">QTY</th>
                        <th class="text-end">SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengembalian->penyewaan->detail as $detail)
                    <tr>
                        <td class="py-2">{{ $detail->barang->nama_barang }}</td>
                        <td class="text-center py-2">{{ $detail->jumlah }}</td>
                        <td class="text-end py-2">
                            Rp {{ number_format($detail->subtotal,0,',','.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-top">
                    <tr>
                        <td colspan="2" class="pt-3">Total Sewa</td>
                        <td class="text-end pt-3">
                            Rp {{ number_format($pengembalian->penyewaan->total_harga,0,',','.') }}
                        </td>
                    </tr>
                    @if($pengembalian->denda > 0)
                    @php
                        $due = \Carbon\Carbon::parse($pengembalian->penyewaan->tanggal_kembali)->startOfDay();
                        $actual = \Carbon\Carbon::parse($pengembalian->tanggal_dikembalikan)->startOfDay();
                        $hariTelat = (int) $due->diffInDays($actual, false);
                    @endphp
                    <tr class="text-danger">
                        <td colspan="2" class="fw-bold">
                            Denda Keterlambatan
                            <small class="d-block text-muted">({{ $hariTelat }} hari x Rp 3.000)</small>
                        </td>
                        <td class="text-end fw-bold">
                            Rp {{ number_format($pengembalian->denda,0,',','.') }}
                        </td>
                    </tr>
                    <tr class="table-dark">
                        <td colspan="2" class="fw-bold py-3">TOTAL YANG HARUS DIBAYAR</td>
                        <td class="text-end fw-bold py-3 fs-5">
                            Rp {{ number_format($pengembalian->denda,0,',','.') }}
                        </td>
                    </tr>
                    @else
                    <tr class="bg-success bg-opacity-10">
                        <td colspan="3" class="text-center py-3 text-success fw-bold">
                            <i class="bi bi-check-circle-fill me-1"></i> TIDAK ADA DENDA - TEPAT WAKTU
                        </td>
                    </tr>
                    @endif
                </tfoot>
            </table>

            @if($pengembalian->kondisi_barang)
            <div class="bg-light rounded p-3 mb-4">
                <small class="text-muted d-block mb-1">KONDISI BARANG SAAT DIKEMBALIKAN</small>
                <span>{{ $pengembalian->kondisi_barang }}</span>
            </div>
            @endif

            <div class="text-center mt-4 pt-3 border-top">
                <p class="fw-bold mb-1">TERIMA KASIH</p>
                <small class="text-muted">
                    Simpan nota ini sebagai bukti pengembalian yang sah
                </small>
            </div>

        </div>
    </div>
</div>

<style>
@media print {
    .no-print { display: none !important; }
    body { background: #fff !important; }
    .card { box-shadow: none !important; border: none !important; }
    .container-fluid { padding: 0 !important; }
}
</style>
@endsection
