@extends('layouts.user')

@section('title', 'dashboard')

@section('content')

<style>
    .welcome-text {
        text-align: center;
        margin: 24px 0 30px;
    }

    .welcome-text h1 {
        font-size: 22px;
        font-weight: 700;
        color: #002e26;
        margin-bottom: 6px;
    }

    .welcome-text p {
        font-size: 13px;
        color: #64748b;
    }

    .catalog-card {
        background: #ffffff;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0,0,0,0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .catalog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 46, 38, 0.08);
        border-color: rgba(0, 46, 38, 0.1);
    }

    .card-img-container {
        position: relative;
        padding-top: 90%; 
        background: #f8fafc;
        overflow: hidden;
    }

    .card-img-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .catalog-card:hover .card-img-container img {
        transform: scale(1.08);
    }

    .card-content {
        padding: 12px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .item-name {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 3px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 34px;
        line-height: 1.3;
    }

    .item-price {
        font-size: 13px;
        font-weight: 600;
        color: #059669;
        margin-bottom: 10px;
    }

    .btn-detail {
        width: 100%;
        border-radius: 8px;
        padding: 6px;
        font-size: 11px;
        font-weight: 600;
        background: #f1f5f9;
        color: #475569;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
        text-align: center;
        display: block;
    }

    .btn-detail:hover {
        background: #002e26;
        color: #ffffff;
    }
</style>


<div class="container py-3">
    <div class="welcome-text">
        <h1>Selamat Datang di GearLeaf Rental</h1>
        <p>Temukan perlengkapan camping terbaik untuk petualanganmu</p>
    </div>


    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
        @foreach ($barang as $item)
            <div class="col">
                <div class="catalog-card">
                    <div class="card-img-container">
                        @php
                            $fotoUrl = null;
                            if ($item->foto) {
                                if (file_exists(public_path('img/' . $item->foto))) {
                                    $fotoUrl = asset('img/' . $item->foto);
                                } elseif (file_exists(storage_path('app/public/' . $item->foto))) {
                                    $fotoUrl = asset('img/' . $item->foto);
                                }
                            }
                        @endphp

                        @if ($fotoUrl)
                            <img src="{{ $fotoUrl }}" alt="{{ $item->nama_barang }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted" style="font-size: 12px;">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama_barang) }}&background=f1f5f9&color=64748b"
                                     class="w-100 h-100 object-fit-cover" alt="no photo">
                            </div>
                        @endif
                    </div>

                    <div class="card-content">
                        <div>
                            <div class="item-name">{{ $item->nama_barang }}</div>
                            <div class="item-price">
                                Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}<span style="font-size: 11px; font-weight: 400; color: #94a3b8;"> / hari</span>
                            </div>
                        </div>

                        <a href="{{ route('user.barang.detail', $item->id_barang) }}" class="btn-detail">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
