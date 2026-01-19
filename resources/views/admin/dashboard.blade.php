@extends('layouts.admin')

@section('content')
<div class="container-fluid">

<style>
    .welcome-banner {
        background: linear-gradient(135deg, #002e26 0%, #1d7c6b 100%);
        border-radius: var(--radius-md);
        padding: 20px 28px;
        color: white;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        right: -30px;
        bottom: -30px;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        z-index: 0;
    }

    .stat-card {
        border: none;
        border-radius: var(--radius-md);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .quick-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 16px;
        background: white;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border-color);
        text-decoration: none;
        color: var(--text-main);
        transition: all 0.2s;
        height: 100%;
    }

    .quick-action-btn:hover {
        background: var(--primary-light);
        border-color: var(--primary);
        color: var(--primary);
        transform: scale(1.03);
    }

    .quick-action-btn i {
        font-size: 20px;
        margin-bottom: 8px;
    }

    .table-container {
        background: white;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .badge-status {
        padding: 5px 10px;
        border-radius: 50px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
    }
</style>

<div class="container-fluid py-2">
    <div class="welcome-banner shadow-sm">
        <div class="d-flex align-items-center justify-content-between position-relative" style="z-index: 1;">
            <div>
                <h5 class="fw-bold mb-1">Selamat Datang, Admin!</h5>
                <small class="opacity-75">Ringkasan operasional GearLeaf Rental hari ini</small>
            </div>
            <div class="d-none d-md-block">
                <span class="opacity-75 small"><i class="bi bi-calendar3 me-1"></i> {{ date('l, d M Y') }}</span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card-modern stat-card d-flex align-items-center justify-content-between p-4 shadow-sm" style="border-left: 5px solid var(--primary);">
                <div>
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">Penyewa Terdaftar</h6>
                    <h2 class="fw-bold mb-0">{{ $totalUser ?? 0 }}</h2>
                </div>
                <div class="bg-primary-light p-3 rounded-3 text-primary">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-modern stat-card d-flex align-items-center justify-content-between p-4 shadow-sm" style="border-left: 5px solid var(--secondary);">
                <div>
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">Total Barang</h6>
                    <h2 class="fw-bold mb-0">{{ $totalBarang ?? 0 }}</h2>
                </div>
                <div class="p-3 rounded-3 text-secondary" style="background: rgba(29, 124, 107, 0.1);">
                    <i class="bi bi-box-seam fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-modern stat-card d-flex align-items-center justify-content-between p-4 shadow-sm" style="border-left: 5px solid #f59e0b;">
                <div>
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">Total Transaksi</h6>
                    <h2 class="fw-bold mb-0">{{ $totalPenyewaan ?? 0 }}</h2>
                </div>
                <div class="p-3 rounded-3 text-warning" style="background: rgba(245, 158, 11, 0.1);">
                    <i class="bi bi-receipt-cutoff fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-modern stat-card d-flex align-items-center justify-content-between p-4 shadow-sm" style="border-left: 5px solid #ef4444;">
                <div>
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">Sewa Berjalan</h6>
                    <h2 class="fw-bold mb-0">{{ $penyewaanAktif ?? 0 }}</h2>
                </div>
                <div class="p-3 rounded-3 text-danger" style="background: rgba(239, 68, 68, 0.1);">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-4">
            <h5 class="fw-bold mb-3">Akses Cepat</h5>
            <div class="row g-3">
                <div class="col-6">
                    <a href="{{ route('admin.penyewaan.create') }}" class="quick-action-btn shadow-sm">
                        <i class="bi bi-plus-circle-fill text-primary"></i>
                        <span class="fw-600 small">Sewa Baru</span>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('admin.barang.create') }}" class="quick-action-btn shadow-sm">
                        <i class="bi bi-box-fill text-success"></i>
                        <span class="fw-600 small">Barang Baru</span>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('admin.laporan.index') }}" class="quick-action-btn shadow-sm">
                        <i class="bi bi-file-earmark-bar-graph-fill text-info"></i>
                        <span class="fw-600 small">Lihat Laporan</span>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('admin.pembayaran.index') }}" class="quick-action-btn shadow-sm">
                        <i class="bi bi-credit-card-fill text-warning"></i>
                        <span class="fw-600 small">Cek Bayar</span>
                    </a>
                </div>
            </div>

            <div class="mt-4">
                <h5 class="fw-bold mb-3">Peringatan Stok Rendah</h5>
                <div class="table-container shadow-sm p-3">
                    @forelse($lowStockItems as $item)
                        <div class="d-flex align-items-center justify-content-between mb-3 last-child-mb-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-2 me-2">
                                    <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                                </div>
                                <div>
                                    <div class="fw-bold small">{{ $item->nama_barang }}</div>
                                    <small class="text-muted">Sisa: {{ $item->stok }} unit</small>
                                </div>
                            </div>
                            <a href="{{ route('admin.barang.edit', $item->id_barang) }}" class="btn btn-sm btn-outline-danger py-1" style="font-size: 10px;">Restock</a>
                        </div>
                    @empty
                        <div class="text-center py-3 text-muted small">
                            Semua stok aman <i class="bi bi-check-circle-fill text-success ms-1"></i>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0">Transaksi Terbaru</h5>
                <a href="{{ route('admin.penyewaan.index') }}" class="text-primary small fw-bold text-decoration-none">Lihat Semua</a>
            </div>
            <div class="table-container shadow-sm">
                <table class="table table-hover mb-0" style="font-size: 14px;">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 border-0">Penyewa</th>
                            <th class="border-0 text-center">Tgl Sewa</th>
                            <th class="border-0 text-center">Total</th>
                            <th class="border-0 text-center">Status</th>
                            <th class="pe-4 border-0 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $tx)
                            <tr>
                                <td class="ps-4 align-middle">
                                    <div class="fw-bold">{{ $tx->user->nama ?? 'User' }}</div>
                                    <small class="text-muted">#{{ $tx->id_penyewaan }}</small>
                                </td>
                                <td class="text-center align-middle">{{ date('d/m/Y', strtotime($tx->tanggal_sewa)) }}</td>
                                <td class="text-center align-middle fw-bold">Rp {{ number_format($tx->total_harga, 0, ',', '.') }}</td>
                                <td class="text-center align-middle">
                                    @if($tx->status == 'dikembalikan')
                                        <span class="badge-status bg-success-subtle text-success">Selesai</span>
                                    @elseif($tx->status == 'disewa')
                                        <span class="badge-status bg-warning-subtle text-warning">Disewa</span>
                                    @else
                                        <span class="badge-status bg-secondary-subtle text-secondary">{{ ucfirst($tx->status) }}</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end align-middle">
                                    <a href="{{ route('admin.penyewaan.show', $tx->id_penyewaan) }}" class="btn btn-sm btn-light py-1 px-3 border"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Belum ada transaksi terbaru</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
