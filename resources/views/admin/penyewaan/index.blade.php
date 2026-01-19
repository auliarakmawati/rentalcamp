@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold">
                <i class="bi bi-bag-check-fill me-2"></i> Data Penyewaan
            </h4>
            <small class="text-muted">Kelola data penyewaan barang</small>
        </div>
        <div class="d-flex align-items-center" style="gap:10px;">
            <form method="GET" action="{{ route('admin.penyewaan.index') }}" class="input-group" style="max-width:300px;">
                <input name="q" type="search" class="form-control form-control-sm"
                       placeholder="Cari nama/email pelanggan..."
                       value="{{ request('q') }}">
                <button class="btn btn-outline-secondary btn-sm" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            @if(Route::has('admin.penyewaan.create'))
                <a href="{{ route('admin.penyewaan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Penyewaan
                </a>
            @else
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card-modern p-0">
        <div class="table-responsive">
            <table class="table-modern mt-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Barang</th>
                        <th>Tgl Sewa</th>
                        <th>Tgl Kembali</th>
                        <th>Total</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penyewaan as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $row->user->nama }}</strong><br>
                            <small>{{ $row->user->email }}</small>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-2">
                                @foreach($row->detail as $d)
                                    @php $b = $d->barang; @endphp
                                    <div class="d-flex align-items-center" style="gap:10px;">
                                        <div>
                                            <div class="fw-bold">{{ $b->nama_barang }}</div>
                                            <div class="small text-muted">
                                                Qty: {{ $d->jumlah }} • Rp {{ number_format($b->harga_sewa,0,',','.') }} /hari
                                                • Subtotal: Rp {{ number_format($d->subtotal,0,',','.') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>{{ $row->tanggal_sewa }}</td>
                        <td>{{ $row->tanggal_kembali }}</td>
                        <td>Rp {{ number_format($row->total_harga,0,',','.') }}</td>
                        <td>Rp {{ number_format($row->denda,0,',','.') }}</td>
                        <td class="text-center">
                            @if($row->status == 'disewa')
                                <span class="badge bg-warning">Disewa</span>
                            @else
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.penyewaan.show', $row->id_penyewaan) }}"
                               class="btn btn-action btn-info text-white" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if($row->status == 'disewa')
                                <a href="{{ Route::has('admin.pengembalian.show') ? route('admin.pengembalian.show', $row->id_penyewaan) : url('/admin/pengembalian/'.$row->id_penyewaan) }}"
                                   class="btn btn-action btn-success" title="Kembalikan">
                                   <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            @else
                                <span class="badge bg-light text-dark border">Selesai</span>
                            @endif
                            <form action="{{ Route::has('admin.penyewaan.destroy') ? route('admin.penyewaan.destroy', $row->id_penyewaan) : url('/admin/penyewaan/'.$row->id_penyewaan) }}"
                                  method="POST"
                                  class="d-inline ms-1 delete-form">
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
                        <td colspan="9" class="text-center text-muted">
                            Belum ada penyewaan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($penyewaan->hasPages())
        <div class="d-flex justify-content-center mt-3">
            <nav>
                {{ $penyewaan->appends(request()->query())->links('pagination::bootstrap-5') }}
            </nav>
        </div>
        <style>
            .pagination { --bs-pagination-padding-x: 0.5rem; --bs-pagination-padding-y: 0.25rem; --bs-pagination-font-size: 0.8rem; }
        </style>
        @endif
    </div>

</div>
@endsection
