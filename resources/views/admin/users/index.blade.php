@extends('layouts.admin')

@section('content')
@section('content')
<style>
    .page-head{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:18px;
        gap:12px;
        flex-wrap:wrap;
    }

    .search-bar{
        min-width:240px;
        max-width:420px;
    }

    .btn-add{
        background: #002e26;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 0.875rem;
    }

    .small-muted{ color:#6c757d; font-size: 0.75rem;}
</style>

<div class="container-fluid">
    <div class="page-head">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-people-fill me-2"></i> Kelola Penyewa
            </h4>
            <small class="small-muted">Daftar penyewa / pengguna sistem</small>
        </div>

        <div class="d-flex gap-2 align-items-center">
            <form method="GET" action="{{ route('admin.users.index') }}" class="input-group search-bar">
                <input type="search"
                       name="q"
                       class="form-control form-control-sm"
                       placeholder="Cari nama / email / no hp..."
                       value="{{ request('q') }}">
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <a href="{{ route('admin.users.create') }}" class="btn btn-add">
                <i class="bi bi-plus-lg me-1"></i> Tambah
            </a>
        </div>
    </div>

    <div class="card-modern p-0">
        <div class="table-responsive">
            <table class="table table-modern align-middle mb-0 mt-0">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Terdaftar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                    <tr>
                        <td>{{ ($users->currentPage()-1)*$users->perPage() + $loop->iteration }}</td>

                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div>
                                    <strong>{{ $u->nama }}</strong><br>
                                    <small class="small-muted">ID: {{ $u->id_user }}</small>
                                </div>
                            </div>
                        </td>

                        <td>{{ $u->email }}</td>
                        <td>{{ $u->alamat ?? '-' }}</td>
                        <td>{{ $u->no_hp ?? '-' }}</td>
                        <td>{{ optional($u->created_at)->format('Y-m-d') }}</td>

                        <td class="text-center">
                            <a href="{{ route('admin.users.edit',$u->id_user) }}"
                               class="btn btn-action btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.users.destroy',$u->id_user) }}"
                                  method="POST"
                                  class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-action btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Data tidak ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div class="d-flex flex-column align-items-center mt-4 gap-1">
            <small class="text-muted">
                Menampilkan {{ $users->count() }} dari {{ $users->total() }} data
            </small>
            {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

</div>
@endsection
