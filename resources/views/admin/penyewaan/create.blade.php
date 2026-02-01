@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold">
                <i class="bi bi-plus-circle me-2"></i> Tambah Penyewaan
            </h4>
            <small class="text-muted">Buat penyewaan manual untuk penyewa</small>
        </div>
        <a href="{{ route('admin.penyewaan.index') }}" class="btn btn-outline-secondary">
            Kembali
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('admin.penyewaan.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="card-modern">
                    <h6 class="fw-bold mb-3 pb-2 border-bottom">Informasi Penyewa</h6>

                    <label class="form-label text-muted small fw-bold text-uppercase">Penyewa</label>
                    <select name="id_user" class="form-select mb-3" required>
                        <option value="">-- Pilih Penyewa --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id_user }}">
                                {{ $u->nama }} — {{ $u->email }}
                            </option>
                        @endforeach
                    </select>

                    <label class="form-label text-muted small fw-bold text-uppercase">Tanggal Sewa</label>
                    <input type="date" name="tanggal_sewa"
                           class="form-control mb-3"
                           value="{{ date('Y-m-d') }}" required>

                    <label class="form-label text-muted small fw-bold text-uppercase">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali"
                           class="form-control" required>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card-modern">

                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <h6 class="fw-bold mb-0">Barang yang disewa</h6>
                        <button type="button" id="add-item" class="btn btn-sm btn-success">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Barang
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th width="80">Foto</th>
                                    <th>Barang</th>
                                    <th width="80">Stok</th>
                                    <th width="120">Harga / hari</th>
                                    <th width="100">Jumlah</th>
                                    <th width="140">Subtotal</th>
                                    <th width="60"></th>
                                </tr>
                            </thead>

                            <tbody id="item-list">
                                <tr class="item-row">
                                    <td class="text-center">
                                        <img src="{{ asset('img/no-image.png') }}"
                                             class="preview-img"
                                             style="width:50px;height:50px;object-fit:cover;border-radius:6px; border:1px solid #eee;">
                                    </td>

                                    <td>
                                        <select name="barang[]" class="form-select form-select-sm select-barang">
                                            <option value="">-- Pilih Barang --</option>
                                            @foreach($barang as $b)
                                                @php
                                                    $fotoUrl = asset('img/no-image.png');
                                                    if ($b->foto) {
                                                        if (file_exists(public_path('img/'.$b->foto))) {
                                                            $fotoUrl = asset('img/'.$b->foto);
                                                        } elseif (file_exists(storage_path('app/public/'.$b->foto))) {
                                                            $fotoUrl = asset('storage/'.$b->foto);
                                                        }
                                                    }
                                                @endphp
                                                <option value="{{ $b->id_barang }}"
                                                    data-harga="{{ $b->harga_sewa }}"
                                                    data-foto="{{ $fotoUrl }}"
                                                    data-stok="{{ $b->stok }}"
                                                    {{ $b->stok <= 0 ? 'disabled' : '' }}>
                                                    {{ $b->nama_barang }} (Tersedia: {{ $b->stok }}){{ $b->stok <= 0 ? ' - Habis' : '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="stok-info text-center">-</td>

                                    <td class="harga text-muted">Rp 0</td>

                                    <td>
                                        <input type="number" name="jumlah[]"
                                               class="form-control form-control-sm qty"
                                               min="1" max="1" value="1">
                                    </td>

                                    <td class="subtotal fw-bold text-primary">Rp 0</td>

                                    <td>
                                        <button type="button" class="btn btn-sm btn-light text-danger remove-item" style="border: 1px solid #eee;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 p-3 bg-light rounded text-end">
                        <span class="text-muted me-2">Total Estimasi:</span>
                        <strong id="totalAmount" class="fs-4 text-dark">Rp 0</strong>
                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="bi bi-save me-2"></i> Simpan Penyewaan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
const placeholderImg = "{{ asset('img/no-image.png') }}";

function rupiah(n){
    return 'Rp ' + Number(n || 0).toLocaleString('id-ID');
}

function updateRow(row){
    const sel = row.querySelector('.select-barang');
    const opt = sel.options[sel.selectedIndex];
    const harga = parseInt(opt?.dataset?.harga || 0);
    const stok = parseInt(opt?.dataset?.stok || 0);
    const qtyInput = row.querySelector('.qty');
    let qty = parseInt(qtyInput.value || 1);

    const stokCell = row.querySelector('.stok-info');
    if (opt?.value) {
        stokCell.textContent = stok;
        qtyInput.max = stok;
        
        if (qty > stok) {
            qty = stok;
            qtyInput.value = stok;
        }
    } else {
        stokCell.textContent = '-';
        qtyInput.max = 1;
    }

    row.querySelector('.harga').textContent = rupiah(harga);
    row.querySelector('.subtotal').textContent = rupiah(harga * qty);
    row.querySelector('.preview-img').src = opt?.dataset?.foto || placeholderImg;

    calcTotal();
}

function calcTotal(){
    let total = 0;
    document.querySelectorAll('.subtotal').forEach(el=>{
        total += parseInt(el.textContent.replace(/\D/g,'')) || 0;
    });
    document.getElementById('totalAmount').textContent = rupiah(total);
}

function attach(row){
    row.querySelector('.select-barang').onchange = ()=>updateRow(row);
    row.querySelector('.qty').oninput = ()=>updateRow(row);

    row.querySelector('.remove-item').onclick = ()=>{
        if(document.querySelectorAll('.item-row').length <= 1){
            alert('Minimal satu barang');
            return;
        }
        row.remove();
        calcTotal();
    };
}

attach(document.querySelector('.item-row'));

document.getElementById('add-item').onclick = ()=>{
    const tr = document.querySelector('.item-row').cloneNode(true);
    tr.querySelector('.select-barang').value = '';
    tr.querySelector('.qty').value = 1;
    tr.querySelector('.qty').max = 1;
    tr.querySelector('.harga').textContent = 'Rp 0';
    tr.querySelector('.subtotal').textContent = 'Rp 0';
    tr.querySelector('.stok-info').textContent = '-';
    tr.querySelector('.preview-img').src = placeholderImg;

    document.getElementById('item-list').appendChild(tr);
    attach(tr);
};
</script>
@endsection
