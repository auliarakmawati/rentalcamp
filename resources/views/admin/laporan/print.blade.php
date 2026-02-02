<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff;
            color: #000;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: middle;
        }
        .table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        
        @media print {
            @page {
                size: A4;
                margin: 2cm;
            }
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>GearLeaf Rental Camp</h2>
        <p>Laporan Transaksi Penyewaan</p>
        @if($startDate && $endDate)
            <p>Periode: {{ date('d/m/Y', strtotime($startDate)) }} s/d {{ date('d/m/Y', strtotime($endDate)) }}</p>
        @else
            <p>Periode: 
                @php
                    $monthNames = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                @endphp
                @foreach($bulans as $b)
                    {{ $monthNames[(int)$b] }}
                @endforeach
                {{ $tahun }}
            </p>
        @endif
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 25%">Pelanggan</th>
                <th style="width: 15%">Tgl Sewa</th>
                <th style="width: 15%">Tgl Kembali</th>
                <th style="width: 15%">Status</th>
                <th style="width: 25%">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        <div>{{ $row->user->nama ?? '-' }}</div>
                        <small>{{ $row->user->email ?? '' }}</small>
                    </td>
                    <td class="text-center">{{ date('d/m/Y', strtotime($row->tanggal_sewa)) }}</td>
                    <td class="text-center">{{ date('d/m/Y', strtotime($row->tanggal_kembali)) }}</td>
                    <td class="text-center">
                        @if($row->status == 'disewa')
                            Disewa
                        @elseif($row->status == 'dikembalikan')
                            Selesai
                        @else
                            {{ ucfirst($row->status) }}
                        @endif
                    </td>
                    <td class="text-end">
                        Rp {{ number_format($row->total_harga + $row->denda, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-end" style="font-weight: bold;">Total Pendapatan</td>
                <td class="text-end" style="font-weight: bold;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 50px; text-align: right;">
        @php
            $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
            $months = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            $formattedDate = $date->format('d') . ' ' . $months[(int)$date->format('n')] . ' ' . $date->format('Y H:i');
        @endphp
        <p>Dicetak pada: {{ $formattedDate }}</p>
    </div>

</body>
</html>
