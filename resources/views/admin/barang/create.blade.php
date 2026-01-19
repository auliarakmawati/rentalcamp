@extends('layouts.admin')

@section('content')
    <div class="container-fluid" style="max-width: 900px;">


        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold"><i class="bi bi-box-seam me-2"></i> Tambah Barang</h4>
                <small class="text-muted">Tambahkan barang baru ke sistem penyewaan</small>
            </div>

            <a href="{{ route('admin.barang.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-modern">
            <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    <div class="col-md-8">

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required>
                            @error('nama_barang')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                            @error('deskripsi')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Foto Barang</label>
                            <input type="file" name="foto" class="form-control">
                            <small class="text-muted">Format: JPG, JPEG, PNG — Maksimal 2MB</small>
                            @error('foto')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold text-uppercase">Harga Sewa <span class="fw-normal text-muted">(per hari)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">Rp</span>
                                    <input type="number" name="harga_sewa" class="form-control border-start-0 ps-0" required>
                                </div>
                                @error('harga_sewa')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold text-uppercase">Stok Awal</label>
                                <input type="number" name="stok" class="form-control" required>
                                @error('stok')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-4 py-2">
                            <i class="bi bi-save me-1"></i> Simpan Barang
                        </button>
                    </div>

                </div>

            </form>
        </div>

    </div>
@endsection
