@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-arrow-counterclockwise me-2"></i> Konfirmasi Pengembalian
        </h4>
        <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold text-uppercase text-muted mb-3" style="font-size: 12px; letter-spacing: 1px;">Informasi Penyewa</h6>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light rounded-circle p-3 me-3 text-primary">
                            <i class="bi bi-person-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $penyewaan->user->nama }}</h5>
                            <small class="text-muted">{{ $penyewaan->user->email }}</small>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-2 small">
                        <div class="col-6 text-muted">Tgl Sewa</div>
                        <div class="col-6 text-end fw-bold">{{ date('d M Y', strtotime($penyewaan->tanggal_sewa)) }}</div>
                        <div class="col-6 text-muted">Jatuh Tempo</div>
                        <div class="col-6 text-end fw-bold text-danger">{{ date('d M Y', strtotime($penyewaan->tanggal_kembali)) }}</div>
                    </div>
                </div>
            </div>


            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold text-uppercase text-muted mb-3" style="font-size: 12px; letter-spacing: 1px;">Form Pengembalian</h6>

                    <form method="POST" action="{{ route('admin.pengembalian.store') }}">
                        @csrf
                        <input type="hidden" name="id_penyewaan" value="{{ $penyewaan->id_penyewaan }}">

                        <div class="mb-3">
                            <label class="form-label small text-muted">Tanggal Dikembalikan</label>
                            <input type="date" name="tanggal_dikembalikan" class="form-control" value="{{ date('Y-m-d') }}" required>
                            <div class="form-text text-muted" style="font-size: 11px;">
                                *Denda Rp 3.000/hari akan dihitung otomatis jika melewati tanggal jatuh tempo.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small text-muted">Kondisi Barang / Catatan</label>
                            <textarea name="kondisi_barang" class="form-control" rows="3" placeholder="Contoh: Barang lengkap, tenda sedikit kotor..."></textarea>
                        </div>

                        <button class="btn btn-success w-100 py-2">
                            <i class="bi bi-check-circle-fill me-1"></i> Simpan Pengembalian
                        </button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0">Barang yang Disewa</h6>
                </div>
                <div class="card-body bg-light">
                    <div class="row g-3">
                        @foreach($items as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm overflow-hidden">
                                <div class="ratio ratio-4x3 bg-secondary bg-opacity-10">
                                    @if(!empty($item['foto']))
                                        <img src="{{ asset('img/' . $item['foto']) }}" class="object-fit-cover" alt="{{ $item['nama_barang'] }}">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center text-muted">
                                            <i class="bi bi-image fs-1"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body text-center p-3">
                                    <h6 class="fw-bold text-dark mb-1">{{ $item['nama_barang'] }}</h6>
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill">
                                        {{ $item['jumlah'] }} Unit
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
