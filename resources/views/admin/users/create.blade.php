@extends('layouts.admin')

@section('content')
    <style>
        :root {
            --card: #fff;
            --accent: #002e26;
            --accent-2: #064234;
            --muted: #6b7280;
        }

        .wrap-add {
            max-width: 850px;
            margin: 0 auto;
        }

        .header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .card-modern {
            background: var(--card);
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(2, 8, 6, 0.03);
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
        }

        .small-muted {
            color: var(--muted);
            font-size: 13px;
        }
    </style>

    <div class="container-fluid wrap-add">
        <div class="header-row">
            <div>
                <h4 class="mb-0 fw-bold"><i class="bi bi-person-plus-fill me-2"></i> Tambah Pelanggan</h4>
                <small class="small-muted">Tambahkan user/users baru ke sistem</small>
            </div>

            <a href="/admin/users" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-modern">
            <form action="/admin/users" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label small">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small">No HP</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>

                <input type="hidden" name="role" value="user">

                <button type="submit" class="btn btn-save w-100 mt-3">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>

            </form>

        </div>

    </div>
@endsection
