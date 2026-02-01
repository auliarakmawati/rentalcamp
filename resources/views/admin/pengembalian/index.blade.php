@extends('layouts.admin')

@section('content')
<div class="container-fluid">


    <div class="row align-items-center mb-4">
        <div class="col-md-8">
            <h4 class="fw-bold mb-1">
                <i class="bi bi-arrow-counterclockwise me-2"></i> Proses Pengembalian
            </h4>
            <small class="text-muted">
                Daftar barang yang sedang disewa dan menunggu pengembalian.
            </small>
        </div>

        <div class="col-md-4">
            <form method="GET" class="input-group">
                <input type="text" name="q" class="form-control"
                    placeholder="Cari nama / ID..." value="{{ request('q') }}">
                <button class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0 w-100">
                <colgroup>
                    <col style="width:15%">
                    <col style="width:40%">
                    <col style="width:25%">
                    <col style="width:20%">
                </colgroup>

                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Kode Sewa</th>
                        <th>Pelanggan</th>
                        <th>Jatuh Tempo</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($penyewaan as $p)
                        @php
                            $jatuhTempo = new DateTime($p->tanggal_kembali);
                            $hariIni = new DateTime();
                            $jatuhTempo->setTime(0,0,0);
                            $hariIni->setTime(0,0,0);

                            $telatHari = 0;
                            if ($hariIni > $jatuhTempo) {
                                $telatHari = $hariIni->diff($jatuhTempo)->days;
                            }
                        @endphp
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-light text-dark border">
                                    #{{ $p->id_penyewaan }}
                                </span>
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $p->user->nama }}</div>
                                <small class="text-muted">{{ $p->user->email }}</small>
                            </td>

                            <td>
                                <i class="bi bi-calendar-event me-1 text-muted"></i>
                                {{ $jatuhTempo->format('d M Y') }}

                                @if($telatHari > 0)
                                    <span class="badge bg-danger ms-2">
                                        Telat {{ $telatHari }} hari
                                    </span>
                                @endif
                            </td>

                            <td class="text-end pe-4">
                                <a href="{{ route('admin.pengembalian.show', $p->id_penyewaan) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-box-seam me-1"></i> Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="bi bi-clipboard-x display-6 d-block mb-3"></i>
                                Tidak ada barang yang sedang disewa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($penyewaan->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $penyewaan->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
