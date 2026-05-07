<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Detail Respon</title>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <a href="{{ url('/dashboard') }}" class="text-blue-500 text-sm mb-4 inline-block">← Kembali ke Riwayat</a>
        
        <h2 class="text-2xl font-bold mb-4">Detail Laporan</h2>
        <div class="mb-6 p-4 bg-gray-50 rounded">
            <p class="text-gray-800">{{ $item->isi_laporan }}</p>
        </div>

        <h3 class="text-lg font-bold mb-2">Tanggapan Petugas:</h3>
        @if($item->tanggapan)
            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                <p class="text-green-800">{{ $item->tanggapan->tanggapan }}</p>
                <p class="text-xs text-green-600 mt-2">Dibalas pada: {{ $item->tanggapan->tgl_tanggapan }}</p>
            </div>
        @else
            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                <p class="text-yellow-700">Laporan belum ditanggapi oleh petugas.</p>
            </div>
        @endif
    </div>
</body>
</html>