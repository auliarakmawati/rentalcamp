@extends('layouts.admin')

@section('content')
<style>
    :root {
        --card: #fff;
        --accent: #002e26;
        --accent-2: #064234;
        --muted: #6b7280;
    }

    .edit-wrap {
        max-width: 900px;
        margin: 0 auto;
    }

    .header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .profile-card {
        background: var(--card);
        padding: 18px;
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(0,0,0,.06);
        margin-bottom: 16px;
    }

    .profile-name {
        font-size: 18px;
        font-weight: 800;
    }

    .small-muted {
        color: var(--muted);
        font-size: 13px;
    }

    .card-form {
        background: var(--card);
        padding: 22px;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(0,0,0,.05);
    }

    .btn-save {
        background: linear-gradient(180deg, var(--accent-2), var(--accent));
        color: #fff;
        border: none;
        padding: 10px 22px;
        font-weight: 600;
        border-radius: 10px;
    }
</style>

<div class="container-fluid edit-wrap">

    <div class="header-row">
        <div>
            <h4 class="mb-0 fw-bold">
                <i class="bi bi-person-lines-fill me-2"></i>Edit Pelanggan
            </h4>
            <small class="small-muted">
                Perbarui data pelanggan penyewaan
            </small>
        </div>

        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="profile-card">
        <div class="profile-name">{{ $user->nama }}</div>
        <div class="small-muted">
            ID: {{ $user->id_user }} • {{ $user->email }}
        </div>
        <div class="small-muted mt-1">
            Terdaftar: {{ optional($user->created_at)->format('d-m-Y') }}
        </div>
    </div>

    <div class="card-form">
        <form action="{{ url('/admin/users/'.$user->id_user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label small">Nama Pelanggan</label>
                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="{{ old('nama', $user->nama) }}"
                    required
                >
                @error('nama')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label small">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $user->email) }}"
                    required
                >
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label small">No HP</label>
                <input
                    type="text"
                    name="no_hp"
                    class="form-control"
                    value="{{ old('no_hp', $user->no_hp) }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label small">Alamat</label>
                <textarea
                    name="alamat"
                    rows="3"
                    class="form-control"
                >{{ old('alamat', $user->alamat) }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </a>

                <button type="submit" class="btn btn-save">
                    <i class="bi bi-check2-circle me-1"></i> Update
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
