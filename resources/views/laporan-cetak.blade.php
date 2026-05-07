<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengaduan Masyarakat</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; font-size: 12px; }
        th { bg-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
        .no-print { margin-top: 20px; text-align: center; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>LAPORAN PENGADUAN MASYARAKAT</h2>
        <p>Tanggal Cetak: {{ date('d-m-Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>NIK</th>
                <th>Isi Laporan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduan as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->tgl_pengaduan }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->isi_laporan }}</td>
                <td>
                    {{ $item->status == '0' ? 'Menunggu' : ucfirst($item->status) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="no-print">
        <button onclick="window.print()">Cetak Sekarang</button>
        <p><small>*Gunakan fitur "Save as PDF" di browser untuk menyimpan sebagai file.</small></p>
    </div>
</body>
</html>