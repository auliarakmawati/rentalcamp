@extends('layouts.user')

@section('title', 'Detail Barang')

@section('content')
<style>
    .detail-container {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .detail-img-wrapper {
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }

    .detail-img {
        max-width: 100%;
        max-height: 400px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        object-fit: contain;
    }

    .detail-info {
        padding: 40px;
    }

    .item-badge {
        display: inline-block;
        padding: 4px 12px;
        background: #e6f2ed;
        color: #002e26;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        border-radius: 50px;
        margin-bottom: 12px;
    }

    .item-title {
        font-size: 32px;
        font-weight: 800;
        color: #002e26;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .item-id {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 24px;
    }

    .price-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        border-left: 4px solid #002e26;
    }

    .price-label {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 4px;
    }

    .price-value {
        font-size: 28px;
        font-weight: 700;
        color: #059669;
    }

    .detail-label {
        font-size: 16px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .detail-text {
        color: #475569;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .stock-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 40px;
    }

    .stock-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #64748b;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: 0.2s;
    }

    .btn-back:hover {
        color: #002e26;
    }
</style>

<div class="container pb-5">
    
    <div class="mt-4">
        <a href="{{ route('user.dashboard') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Katalog
        </a>
    </div>

    <div class="detail-container">
        <div class="row g-0">
            <div class="col-md-5">
                <div class="detail-img-wrapper h-100">
                    @php
                        $fotoUrl = null;
                        if ($item->foto) {
                            if (file_exists(public_path('img/' . $item->foto))) {
                                $fotoUrl = asset('img/' . $item->foto);
                            } elseif (file_exists(storage_path('app/public/' . $item->foto))) {
                                $fotoUrl = asset('storage/' . $item->foto);
                            }
                        }
                    @endphp

                    @if ($fotoUrl)
                        <img src="{{ $fotoUrl }}" class="detail-img" alt="{{ $item->nama_barang }}">
                    @else
                        <div class="text-muted text-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama_barang) }}&background=f8f9fa&color=64748b&size=200"
                                     class="detail-img" alt="no photo">
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-7">
                <div class="detail-info">
                    <span class="item-badge">Perlengkapan Camping</span>
                    <h1 class="item-title">{{ $item->nama_barang }}</h1>
                    <p class="item-id">ID Barang: #{{ $item->id_barang }}</p>

                    <div class="price-box">
                        <div class="price-label">Biaya Sewa</div>
                        <div class="price-value">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }} <small style="font-weight: 400; font-size: 16px;">/ hari</small></div>
                    </div>

                    <h3 class="detail-label">
                        <i class="bi bi-justify-left"></i> Deskripsi Produk
                    </h3>
                    <p class="detail-text">
                        {{ $item->deskripsi ?? 'Tidak ada deskripsi untuk barang ini.' }}
                    </p>

                    <h3 class="detail-label">
                        <i class="bi bi-info-circle"></i> Status Ketersediaan
                    </h3>
                    <div class="stock-info">
                        <div class="stock-item">
                            <span class="dot bg-success"></span>
                            <span>Tersedia: <strong>{{ $item->stok }}</strong></span>
                        </div>
                        <div class="stock-item">
                            <span class="dot bg-warning"></span>
                            <span>Total Unit: {{ $item->total_stok }}</span>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 shadow-sm" style="border-radius: 12px; background: #f0f9ff; color: #0c4a6e;">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Silakan kunjungi toko kami secara langsung untuk melakukan penyewaan barang ini.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
