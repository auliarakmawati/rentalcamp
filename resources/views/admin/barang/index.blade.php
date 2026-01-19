@extends('layouts.admin')

@section('content')
<style>

    .page-head{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:18px;
        gap:12px;
    }

    .search-bar{
        min-width: 240px;
        max-width: 520px;
    }

    .btn-add{
        background: #002e26;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 0.875rem;
    }

    .small-muted { color: #6c757d; font-size: 0.75rem;}
    .text-truncate-320 { max-width:320px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
</style>

<div class="container-fluid">

    <div class="page-head">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-box-seam me-2"></i> Kelola Barang
            </h4>
            <small class="small-muted">Tambah, edit, dan kelola data barang.</small>
        </div>

        <div class="d-flex gap-2 align-items-center">
            <form method="GET" action="{{ route('admin.barang.index') }}" class="input-group search-bar">
                <input name="q" type="search" class="form-control form-control-sm"
                       placeholder="Cari nama barang..."
                       value="{{ request('q') }}">
                <button class="btn btn-outline-secondary btn-sm" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <a href="{{ route('admin.barang.create') }}" class="btn btn-add">
                <i class="bi bi-plus-lg me-1"></i> Tambah
            </a>
        </div>
    </div>

    <div class="card-modern p-0">
        <div class="table-responsive">
            <table class="table-modern mt-0">
                <thead>
                    <tr>
                        <th style="width:60px">No</th>
                        <th>Barang</th>
                        <th>Deskripsi</th>
                        <th>Harga Sewa</th>
                        <th>Stok</th>
                        <th>Tanggal Input</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($barang as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <div class="d-flex align-items-center gap-2">

                                @php
                                    $fotoUrl = null;
                                    if ($b->foto) {
                                        if (file_exists(public_path('img/'.$b->foto))) {
                                            $fotoUrl = asset('img/'.$b->foto);
                                        } elseif (file_exists(storage_path('app/public/'.$b->foto))) {
                                            $fotoUrl = asset('storage/'.$b->foto);
                                        }
                                    }
                                @endphp

                                @if($fotoUrl)
                                    <img src="{{ $fotoUrl }}" class="avatar-sm" alt="foto barang">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($b->nama_barang) }}&background=002e26&color=fff"
                                         class="avatar-sm" alt="foto barang">
                                @endif

                                <div>
                                    <strong>{{ $b->nama_barang }}</strong><br>
                                    <small class="small-muted">ID: {{ $b->id_barang }}</small>
                                </div>
                            </div>
                        </td>

                        <td class="text-truncate-320">
                            {{ \Illuminate\Support\Str::limit($b->deskripsi ?? '-', 60) }}
                        </td>

                        <td>Rp {{ number_format($b->harga_sewa, 0, ',', '.') }}</td>

                        <td>
                            <div class="fw-bold fs-5 text-dark">{{ $b->total_stok }}</div>
                            <small class="text-muted d-block" style="font-size: 0.75rem;">
                                <span class="text-success">Tersedia: {{ $b->stok }}</span> |
                                <span class="text-warning">Disewa: {{ $b->sedang_disewa }}</span>
                            </small>
                        </td>

                        <td>{{ optional($b->created_at)->format('Y-m-d') }}</td>

                        <td class="text-end">

                            <a href="{{ route('admin.barang.edit', $b->id_barang) }}"
                               class="btn btn-action btn-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.barang.destroy', $b->id_barang) }}"
                                  method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-action btn-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada barang.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>


        @if($barang->hasPages())
        <div class="d-flex justify-content-center mt-3">
            {{ $barang->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
@endsection
