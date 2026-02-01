@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold">
                <i class="bi bi-info-circle-fill me-2 text-primary"></i> Detail Penyewaan #{{ $penyewaan->id_penyewaan }}
            </h4>
            <small class="text-muted">Informasi lengkap transaksi penyewaan</small>
        </div>
        <a href="{{ route('admin.penyewaan.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0">Informasi Pelanggan</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                            <i class="bi bi-person fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $penyewaan->user->nama }}</h5>
                            <span class="text-muted small">{{ $penyewaan->user->email }}</span>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">No HP</span>
                            <span class="fw-bold">{{ $penyewaan->user->no_hp ?? '-' }}</span>
                        </li>
                        <li class="list-group-item px-0">
                            <span class="text-muted d-block mb-1">Alamat</span>
                            <span class="fw-semibold">{{ $penyewaan->user->alamat ?? '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0">Status & Waktu</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3 text-center">
                        @if($penyewaan->status == 'disewa')
                            <span class="badge bg-warning text-dark px-4 py-2 fs-6 rounded-pill">DISEWA</span>
                        @else
                            <span class="badge bg-success px-4 py-2 fs-6 rounded-pill">DIKEMBALIKAN</span>
                        @endif
                    </div>
                    <div class="row g-3 small">
                        <div class="col-6">
                            <label class="text-muted d-block small text-uppercase">Tgl Sewa</label>
                            <span class="fw-bold">{{ date('d M Y', strtotime($penyewaan->tanggal_sewa)) }}</span>
                        </div>
                        <div class="col-6">
                            <label class="text-muted d-block small text-uppercase">Jatuh Tempo</label>
                            <span class="fw-bold text-danger">{{ date('d M Y', strtotime($penyewaan->tanggal_kembali)) }}</span>
                        </div>
                        @if($penyewaan->tanggal_dikembalikan)
                        <div class="col-12 border-top pt-2">
                            <label class="text-muted d-block small text-uppercase">Tgl Kembali Eksak</label>
                            <span class="fw-bold text-success">{{ date('d M Y', strtotime($penyewaan->tanggal_dikembalikan)) }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0">Daftar Barang</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Barang</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Harga Sewa</th>
                                <th class="text-end pe-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penyewaan->detail as $detail)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold">{{ $detail->barang->nama_barang }}</div>
                                </td>
                                <td class="text-center">{{ $detail->jumlah }}</td>
                                <td class="text-end">Rp {{ number_format($detail->barang->harga_sewa, 0, ',', '.') }}</td>
                                <td class="text-end pe-4 fw-bold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold py-3">Total Harga Sewa</td>
                                <td class="text-end pe-4 fw-bold py-3 text-primary">Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h6 class="fw-bold mb-0">Informasi Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            @if($penyewaan->pembayaran)
                            <div class="d-flex align-items-center mb-3 text-success">
                                <i class="bi bi-patch-check-fill fs-4 me-2"></i>
                                <span class="fw-bold">LUNAS - {{ strtoupper($penyewaan->pembayaran->metode) }}</span>
                            </div>
                            <ul class="list-group list-group-flush small">
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-muted">Tgl Bayar</span>
                                    <span>{{ date('d M Y', strtotime($penyewaan->pembayaran->tanggal_bayar)) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-muted">Nominal Dibayar</span>
                                    <span class="fw-bold">Rp {{ number_format($penyewaan->pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
                                </li>
                            </ul>
                            @else
                            <div class="alert alert-warning mb-0 py-2 text-center">
                                <i class="bi bi-exclamation-triangle me-1"></i> Belum ada pembayaran
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold mb-0">Riwayat Pengembalian</h6>
                            @if($penyewaan->denda > 0)
                                <span class="badge bg-danger">Telat</span>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($penyewaan->pengembalian)
                            @if($penyewaan->denda > 0)
                            <div class="bg-danger bg-opacity-10 text-danger p-3 rounded mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="fw-bold text-uppercase">Denda Keterlambatan</small>
                                    <h5 class="fw-bold mb-0">Rp {{ number_format($penyewaan->denda, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                            @endif

                            <label class="text-muted small text-uppercase d-block mb-1">Kondisi Barang</label>
                            <p class="fw-semibold mb-0">{{ $penyewaan->pengembalian->kondisi_barang ?? 'Tidak ada catatan' }}</p>
                            @else
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-clock-history fs-1 d-block mb-2"></i>
                                <small>Barang belum dikembalikan</small>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
