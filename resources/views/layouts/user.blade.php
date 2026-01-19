<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user — @yield('title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
        }

        .user-header {
            background: #002e26;
            padding: 12px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .search-box {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            height: 40px;
            padding: 0 15px;
            display: flex;
            align-items: center;
            color: #ffffff;
            width: 280px;
            transition: all 0.2s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .search-box:focus-within {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.05);
        }

        .search-box i {
            font-size: 16px;
            margin-right: 10px;
            color: rgba(255, 255, 255, 0.7);
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            font-weight: 500;
            background: transparent;
            color: #ffffff;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .header-icon {
            color: #ffffff;
            font-size: 24px;
            text-decoration: none;
            margin-left: 20px;
            transition: color 0.2s;
        }

        .header-icon:hover {
            color: #ccecd4;
        }

        footer {
            background: #002e26;
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            padding: 30px 0;
            margin-top: auto;
            width: 100%;
            border-top: none;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-success {
            background-color: #002e26;
            border-color: #002e26;
            color: #ffffff;
            border-radius: 10px;
            font-weight: 600;
        }
        .btn-success:hover {
            background-color: #001a15;
            border-color: #001a15;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="user-header">
        <div class="brand-logo">
            <img src="{{ asset('img/logoo.png') }}" style="height:52px;">
        </div>

        <div class="d-flex align-items-center gap-3">

            <form action="{{ route('user.dashboard') }}" method="GET">
                <div class="search-box d-flex align-items-center px-2">
                    <i class="bi bi-search"></i>
                    <input type="text" name="q" placeholder="Cari barang..." value="{{ request('q') }}" />
                </div>
            </form>

            <a href="{{ route('login') }}" class="btn btn-sm btn-light text-success fw-bold ms-2 shadow-sm"
               style="border-radius: 10px; padding: 6px 16px; font-size: 13px; border: none;">
                <i class="bi bi-person-fill-lock me-1"></i> Admin
            </a>
        </div>
    </div>

    <main class="flex-grow-1">
        @yield('content')
    </main>
    <footer>
        © {{ date('Y') }} GearLeaf | Rental Camp — all rights reserved.
    </footer>

</body>

</html>
