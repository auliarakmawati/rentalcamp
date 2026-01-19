<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | {{ $title ?? 'Dashboard' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {

            --primary: #002e26;
            --primary-light: #e6f2ed;
            --secondary: #1d7c6b;
            --accent: #d4a373;

            --bg-body: #f4f6f8;
            --bg-surface: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;

            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-sm: 8px;

            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
        }


        .sidebar {
            width: 260px;
            height: 100vh;
            background: #002e26;
            border-right: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .logo-area {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: #00221c;
        }

        .sidebar .logo-area img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .sidebar .logo-area .brand-text {
            margin-left: 10px;
            font-weight: 700;
            font-size: 16px;
            color: #ffffff;
            line-height: 1.2;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed .logo-area .brand-text { display: none; }
        .sidebar.collapsed .logo-area { padding: 0; justify-content: center; }

        .sidebar-nav {
            padding: 10px 12px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 8px 16px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            border-radius: var(--radius-sm);
            transition: all 0.2s ease;
            font-size: 0.925rem;
        }

        .sidebar a i {
            font-size: 1.25rem;
            margin-right: 12px;
            color: rgba(255, 255, 255, 0.8);
            transition: color 0.2s;
            width: 24px; text-align: center;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }
        .sidebar a:hover i {
            color: #ffffff;
        }

        .sidebar a.active {
            background-color: #ffffff;
            color: #002e26;
            box-shadow: var(--shadow-sm);
        }
        .sidebar a.active i {
            color: #002e26;
        }

        .sidebar.collapsed a span { display: none; }
        .sidebar.collapsed a { justify-content: center; padding: 12px; }
        .sidebar.collapsed a i { margin-right: 0; }

        .content {
            margin-left: 260px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            display: flex; flex-direction: column;
        }
        .content.collapsed { margin-left: 80px; }

        .header {
            height: 80px;
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky; top: 0; z-index: 999;
        }

        .header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.125rem;
            color: var(--text-main);
        }

        .header .logout-btn {
            color: var(--text-muted);
            font-size: 1.25rem;
            transition: 0.2s;
            padding: 8px; border-radius: 50%;
        }
        .header .logout-btn:hover {
            color: #ef4444;
            background: #fef2f2;
        }

        .card-modern {
            background: var(--bg-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            padding: 24px;
            margin-bottom: 24px;
        }

        .btn {
            padding: 10px 18px;
            font-weight: 600;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .btn-action {
            padding: 4px 8px;
            font-size: 0.75rem;
            border-radius: 6px;
            line-height: 1;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .btn-info {
            background-color: #1e3a5f;
            border-color: #1e3a5f;
            color: #ffffff;
        }
        .btn-info:hover {
            background-color: #152d4a;
            border-color: #152d4a;
            color: #ffffff;
        }

        .btn-success {
            background-color: #002e26;
            border-color: #002e26;
            color: #ffffff;
        }
        .btn-success:hover {
            background-color: #001a15;
            border-color: #001a15;
            color: #ffffff;
        }

        .form-control, .form-select {
            padding: 10px 14px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
            background-color: #ffffff;
            font-size: 0.925rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(29, 124, 107, 0.15);
        }

        .table-modern {
            margin-top: 10px;
        }
        .table-modern thead th {
            background: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color);
            padding: 12px 16px;
        }
        .table-modern tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            font-size: 0.875rem;
            vertical-align: middle;
        }
        .table-modern tbody tr {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .table-modern tbody tr:last-child td { border-bottom: none; }
        .table-modern tbody tr:hover {
            background-color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 1;
        }

        .avatar-sm {
            width: 40px; height: 40px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            border: 1px solid var(--border-color);
        }

        .pagination .page-link {
            border: none;
            color: var(--text-muted);
            border-radius: 6px;
            margin: 0 2px;
            font-weight: 500;
            font-size: 0.875rem;
        }
        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            color: white;
        }
    </style>
</head>

<body>
    <div id="sidebar" class="sidebar">

        <div class="logo-area">
            <img src="{{ asset('img/logoo.png') }}" alt="Logo">
            <div class="brand-text">
                <span>RentalCamp</span>
                <small style="font-weight: 400; font-size: 12px; opacity: 0.7;">Panel Admin</small>
            </div>
        </div>

        <div class="sidebar-nav">
            <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
                class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i><span>Penyewa</span>
            </a>

            <a href="/admin/barang" class="{{ request()->is('admin/barang*') ? 'active' : '' }}">
                <i class="bi bi-box-fill"></i>
                <span>Barang</span>
            </a>

            <a href="/admin/penyewaan" class="{{ request()->is('admin/penyewaan*') ? 'active' : '' }}">
                <i class="bi bi-cart-fill"></i>
                <span>Penyewaan</span>
            </a>

            <a href="/admin/pembayaran" class="{{ request()->is('admin/pembayaran*') ? 'active' : '' }}">
                <i class="bi bi-wallet-fill"></i>
                <span>Pembayaran</span>
            </a>

            <a href="/admin/pengembalian" class="{{ request()->is('admin/pengembalian*') ? 'active' : '' }}">
                <i class="bi bi-arrow-return-left"></i>
                <span>Pengembalian</span>
            </a>

            <a href="{{ route('admin.laporan.index') }}" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Laporan</span>
            </a>

            <div style="border-top: 1px solid rgba(255, 255, 255, 0.1); margin: 10px 0;"></div>

            <a href="{{ route('user.dashboard') }}" target="_blank">
                <i class="bi bi-globe"></i>
                <span>Buka Katalog</span>
            </a>
            <a href="#" onclick="toggleSidebar()">
                <i class="bi bi-layout-sidebar"></i>
                <span>Sembunyikan</span>
            </a>
        </div>
    </div>

    <div id="content" class="content">
        <div class="header">
            <h5>{{ $title ?? 'Dashboard' }}</h5>

            <div class="d-flex align-items-center">
                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                    @csrf
                </form>
                <a href="#" class="logout-btn" title="Keluar"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-power"></i>
                </a>
            </div>
        </div>

        <div class="p-3">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("content").classList.toggle("collapsed");
        }
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Yakin hapus data ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
