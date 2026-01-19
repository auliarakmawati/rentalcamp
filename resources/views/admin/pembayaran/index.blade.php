@extends('layouts.admin')

@section('content')
<style>
    .page-head{
        display:flex; justify-content:space-between; align-items:center;
        margin-bottom:18px; gap:12px;
    }
</style>

<div class="container-fluid">

    <div class="page-head">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-credit-card-2-front-fill me-2"></i> Kelola Pembayaran
            </h4>
            <small class="text-muted">Data pembayaran yang dilakukan user.</small>
        </div>

        <form method="GET" class="input-group" style="max-width:360px;">
            <input type="search" name="q" class="form-control form-control-sm"
                   placeholder="Cari nama pelanggan..." value="{{ request('q') }}">
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <div class="card-modern p-0">
        <div class="table-responsive">
            <table class="table table-modern align-middle mb-0 mt-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Penyewaan</th>
                        <th>Jumlah Bayar</th>
                        <th>Metode</th>
                        <th>Tanggal Bayar</th>
                        <th class="text-end">Detail</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pembayaran as $row)
                    <tr>
                        <td>{{ $loop->iteration + ($pembayaran->currentPage()-1)*$pembayaran->perPage() }}</td>

                        <td>
                            <strong>{{ $row->penyewaan->user->nama ?? '-' }}</strong><br>
                            <small class="text-muted">{{ $row->penyewaan->user->email ?? '' }}</small>
                        </td>

                        <td>
                            ID: <strong>{{ $row->id_penyewaan }}</strong><br>
                            <small>{{ $row->penyewaan->tanggal_sewa }} → {{ $row->penyewaan->tanggal_kembali }}</small>
                        </td>

                        <td>Rp {{ number_format($row->jumlah_bayar, 0, ',', '.') }}</td>
                        <td><span class="badge bg-info">{{ $row->metode }}</span></td>
                        <td>{{ $row->tanggal_bayar }}</td>

                        <td class="text-end">
                            <a href="{{ route('admin.pembayaran.show', $row->id_pembayaran) }}"
                               class="btn btn-action btn-primary" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada pembayaran.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <small class="text-muted">
                Menampilkan {{ $pembayaran->count() }} dari {{ $pembayaran->total() }} data
            </small>

            {{ $pembayaran->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
