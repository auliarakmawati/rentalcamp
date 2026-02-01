@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="row align-items-center mb-4">
        <div class="col-md-8">
            <h4 class="fw-bold mb-1">
                <i class="bi bi-file-earmark-text me-2"></i> Laporan Bulanan
            </h4>
            <small class="text-muted">
                Rekap transaksi penyewaan per bulan
            </small>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-bottom">
            <h6 class="fw-bold mb-0 text-success">
                <i class="bi bi-funnel me-1"></i> Filter Laporan
            </h6>
        </div>
        <div class="card-body bg-light bg-opacity-10">
            <form action="{{ route('admin.laporan.index') }}" method="GET">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="p-3 bg-white rounded shadow-sm h-100">
                            <label class="form-label small fw-bold text-muted text-uppercase mb-3 d-block">
                                <i class="bi bi-calendar-range me-1"></i> Periode Tanggal
                            </label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}" placeholder="Tgl Awal">
                                </div>
                                <div class="col-6">
                                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}" placeholder="Tgl Akhir">
                                </div>
                            </div>
                            <small class="text-muted mt-2 d-block" style="font-size: 11px;">
                                *Jika isi tanggal, filter bulan & tahun diabaikan.
                            </small>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="p-3 bg-white rounded shadow-sm h-100">
                            <label class="form-label small fw-bold text-muted text-uppercase mb-3 d-block">
                                <i class="bi bi-calendar3 me-1"></i> Pilih Bulan & Tahun
                            </label>
                            <div class="row g-2">
                                <div class="col-md-8">
                                    <select name="bulan[]" class="form-select" multiple size="3" style="min-height: 80px;">
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ in_array($i, $bulans) ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                    <small class="text-muted mt-1 d-block" style="font-size: 10px;">
                                        Tahan Ctrl (Windows) / Cmd (Mac) untuk pilih lebih dari 1 bulan.
                                    </small>
                                </div>
                                <div class="col-md-4">
                                    <select name="tahun" class="form-select">
                                        @for($i = date('Y'); $i >= 2020; $i--)
                                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 gap-2">
                    <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-search me-1"></i> Terapkan Filter
                    </button>
                    <button type="button" onclick="window.print()" class="btn btn-success px-4">
                        <i class="bi bi-printer me-1"></i> Cetak Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0 w-100">
                <colgroup>
                    <col style="width:5%">
                    <col style="width:30%">
                    <col style="width:15%">
                    <col style="width:15%">
                    <col style="width:15%">
                    <col style="width:20%">
                </colgroup>

                <thead class="table-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Pelanggan</th>
                        <th>Tgl Sewa</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($laporan as $row)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration }}</td>

                            <td>
                                <div class="fw-semibold">{{ $row->user->nama ?? '-' }}</div>
                                <small class="text-muted">{{ $row->user->email ?? '' }}</small>
                            </td>

                            <td>{{ \Carbon\Carbon::parse($row->tanggal_sewa)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->tanggal_kembali)->format('d M Y') }}</td>

                            <td>
                                @if($row->status == 'disewa')
                                    <span class="badge bg-warning text-dark">Disewa</span>
                                @elseif($row->status == 'dikembalikan')
                                    <span class="badge bg-success">Dikembalikan</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($row->status) }}</span>
                                @endif
                            </td>

                            <td class="text-end pe-4">
                                Rp {{ number_format($row->total_harga + $row->denda, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                Tidak ada data untuk periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                <tfoot class="table-light">
                    <tr>
                        <td colspan="5" class="text-end fw-bold py-3">
                            Total Pendapatan
                        </td>
                        <td class="text-end fw-bold py-3 pe-4">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<style>
@media print {
    .btn, form { display: none !important; }
    body { background: #fff !important; }
    .card { border: none !important; box-shadow: none !important; }
}
</style>
@endsection
