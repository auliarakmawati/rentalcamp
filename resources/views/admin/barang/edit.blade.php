@extends('layouts.admin')

@section('content')
<style>
    :root {
        --card: #fff;
        --accent: #002e26;
        --accent-2: #064234;
        --muted: #6b7280;
    }

    .wrap-edit {
        max-width: 900px;
        margin: 0 auto;
    }

    .header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .card-modern {
        background: var(--card);
        padding: 22px;
        border-radius: 14px;
        box-shadow: 0 8px 28px rgba(0,0,0,.06);
        border: 1px solid rgba(2,8,6,.03);
    }

    .form-label.small {
        font-size: 13px;
        font-weight: 600;
        color: var(--muted);
    }

    .btn-save {
        background: linear-gradient(180deg, var(--accent-2), var(--accent));
        color: #fff;
        border: none;
        padding: 10px 22px;
        border-radius: 10px;
        font-weight: 600;
    }

    .small-muted {
        color: var(--muted);
        font-size: 13px;
    }

    .preview-img {
        width: 120px;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(0,0,0,.12);
    }
</style>

<div class="container-fluid wrap-edit">


    <div class="header-row">
        <div>
            <h4 class="mb-0 fw-bold">
                <i class="bi bi-pencil-square me-2"></i> Edit Barang
            </h4>
            <small class="small-muted">
                Perbarui data barang sewaan
            </small>
        </div>

        <a href="{{ route('admin.barang.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-modern">
        <form
            action="{{ route('admin.barang.update', $barang->id_barang) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="row g-4">

                <div class="col-md-8">

                    <div class="mb-3">
                        <label class="form-label small">Nama Barang</label>
                        <input
                            type="text"
                            name="nama_barang"
                            class="form-control"
                            value="{{ old('nama_barang', $barang->nama_barang) }}"
                            required
                        >
                        @error('nama_barang')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small">Deskripsi</label>
                        <textarea
                            name="deskripsi"
                            rows="3"
                            class="form-control"
                        >{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small">Harga Sewa</label>
                            <input
                                type="number"
                                name="harga_sewa"
                                class="form-control"
                                value="{{ old('harga_sewa', $barang->harga_sewa) }}"
                                required
                            >
                            @error('harga_sewa')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label small">Stok (Tersedia)</label>
                            <input
                                type="number"
                                name="stok"
                                class="form-control"
                                value="{{ old('stok', $barang->stok) }}"
                                required
                            >
                            <small class="text-muted" style="font-size:11px;">*Masukkan sisa stok yang ada di gudang saat ini</small>
                            @error('stok')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>


                <div class="col-md-4">

                    <div class="mb-3">
                        <label class="form-label small d-block">Foto Saat Ini</label>
                        @php
                            $fotoUrl = null;
                            if ($barang->foto) {
                                if (file_exists(public_path('img/'.$barang->foto))) {
                                    $fotoUrl = asset('img/'.$barang->foto);
                                } elseif (file_exists(storage_path('app/public/'.$barang->foto))) {
                                    $fotoUrl = asset('storage/'.$barang->foto);
                                }
                            }
                        @endphp

                        @if ($fotoUrl)
                            <img src="{{ $fotoUrl }}" class="preview-img mb-2">
                        @else
                            <div class="small-muted">Belum ada foto</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label small">Ganti Foto</label>
                        <input type="file" name="foto" class="form-control">
                        <small class="small-muted">
                            Kosongkan jika tidak ingin mengganti foto
                        </small>
                    </div>


                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-save">
                            <i class="bi bi-check2-circle me-1"></i> Update Barang
                        </button>

                        <a href="{{ route('admin.barang.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                    </div>

                </div>

            </div>
        </form>
    </div>

</div>
@endsection
