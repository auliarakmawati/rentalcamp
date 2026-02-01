@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <div>
            <h4 class="fw-bold mb-0">Struk Pembayaran</h4>
            <small class="text-muted">Bukti pembayaran resmi rental</small>
        </div>
        <div>
            <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button class="btn btn-primary" onclick="window.print()">
                <i class="bi bi-printer-fill me-1"></i> Cetak Struk
            </button>
        </div>
    </div>


    <div class="card border-0 shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body p-5">

            <div class="text-center mb-4">
                <h3 class="fw-bold text-uppercase mb-1">GearLeaf | RentalCamp</h3>
                <small class="text-muted d-block">Rental & Outdoor Equipment</small>
                <small class="text-muted">Telp: 0857-0676-0096</small>
            </div>

            <hr class="my-4">


            <div class="row mb-3">
                <div class="col-6">
                    <small class="text-muted d-block">NO. PEMBAYARAN</small>
                    <span class="fw-bold">#PAY-{{ str_pad($pembayaran->id_pembayaran, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="col-6 text-end">
                    <small class="text-muted d-block">TANGGAL BAYAR</small>
                    <span class="fw-bold">
                        {{ date('d/m/Y', strtotime($pembayaran->tanggal_bayar)) }}
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <small class="text-muted d-block">PENYEWA</small>
                    <span class="fw-bold">{{ $pembayaran->penyewaan->user->nama }}</span>
                </div>
                <div class="col-6 text-end">
                    <small class="text-muted d-block">METODE</small>
                    <span class="badge bg-success">TUNAI</span>
                </div>
            </div>


            <div class="row mb-4">
                <div class="col-6">
                    <small class="text-muted d-block">TGL SEWA</small>
                    <span>{{ date('d/m/Y', strtotime($pembayaran->penyewaan->tanggal_sewa)) }}</span>
                </div>
                <div class="col-6 text-end">
                    <small class="text-muted d-block">TGL KEMBALI</small>
                    <span>{{ date('d/m/Y', strtotime($pembayaran->penyewaan->tanggal_kembali)) }}</span>
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
                    @foreach($pembayaran->penyewaan->detail as $detail)
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
                        <td colspan="2" class="fw-bold pt-3">TOTAL</td>
                        <td class="text-end fw-bold pt-3">
                            Rp {{ number_format($pembayaran->penyewaan->total_harga,0,',','.') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-muted">UANG DIBAYAR</td>
                        <td class="text-end">
                            Rp {{ number_format($pembayaran->jumlah_bayar,0,',','.') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-muted">KEMBALIAN</td>
                        <td class="text-end">
                            Rp {{ number_format($pembayaran->jumlah_bayar - $pembayaran->penyewaan->total_harga,0,',','.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>


            <div class="text-center mt-4 pt-3 border-top">
                <p class="fw-bold mb-1">TERIMA KASIH</p>
                <small class="text-muted">
                    Simpan struk ini sebagai bukti pembayaran yang sah
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
