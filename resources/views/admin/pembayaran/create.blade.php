@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-3">
        <i class="bi bi-cash-coin me-2"></i> Pembayaran Penyewaan (Tunai)
    </h4>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif


    <div class="card mb-3">
        <div class="card-body">
            <strong>Nama Penyewa:</strong> {{ $penyewaan->user->nama }} <br>
            <strong>Tanggal Sewa:</strong> {{ $penyewaan->tanggal_sewa }} <br>
            <strong>Tanggal Kembali:</strong> {{ $penyewaan->tanggal_kembali }} <br>
            <strong>Status:</strong>
            <span class="badge bg-warning text-dark">
                {{ strtoupper($penyewaan->status) }}
            </span>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header fw-bold">Detail Barang Disewa</div>
        <div class="table-responsive">
            <table class="table table-bordered mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail as $i => $d)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $d->barang->nama_barang }}</td>
                        <td>{{ $d->jumlah }}</td>
                        <td>
                            Rp {{ number_format($d->subtotal,0,',','.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total Tagihan</th>
                        <th>
                            Rp {{ number_format($penyewaan->total_harga,0,',','.') }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header fw-bold">Form Pembayaran Tunai</div>
        <div class="card-body">
            <form action="{{ route('admin.pembayaran.store') }}" method="POST">
                @csrf

                <input type="hidden" name="id_penyewaan" value="{{ $penyewaan->id_penyewaan }}">
                <input type="hidden" name="metode" value="tunai">


                <div class="mb-3">
                    <label class="form-label">Total Tagihan</label>
                    <input type="text"
                        class="form-control"
                        value="Rp {{ number_format($penyewaan->total_harga,0,',','.') }}"
                        readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Uang Dibayar</label>
                    <input type="number"
                        name="jumlah_bayar"
                        id="jumlah_bayar"
                        class="form-control"
                        placeholder="Masukkan uang dari penyewa"
                        min="{{ $penyewaan->total_harga }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kembalian</label>
                    <input type="text"
                        id="kembalian"
                        class="form-control"
                        value="Rp 0"
                        readonly>
                </div>

                <button class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i> Simpan Pembayaran
                </button>

                <a href="{{ route('admin.penyewaan.index') }}" class="btn btn-secondary ms-2">
                    Kembali
                </a>
            </form>
        </div>
    </div>

</div>


<script>
    const total = {{ $penyewaan->total_harga }};
    const bayarInput = document.getElementById('jumlah_bayar');
    const kembalianInput = document.getElementById('kembalian');

    bayarInput.addEventListener('input', function () {
        const bayar = parseInt(this.value || 0);
        const kembali = bayar - total;

        kembalianInput.value = kembali > 0
            ? 'Rp ' + kembali.toLocaleString('id-ID')
            : 'Rp 0';
    });
</script>
@endsection
