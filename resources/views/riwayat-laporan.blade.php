<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan Anda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 font-sans">
    <div class="max-w-5xl mx-auto">
        <div class="mb-4">
            <a href="{{ url('/') }}" class="text-blue-600 hover:underline font-medium text-sm">← Kembali</a>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h2 class="text-xl font-bold text-gray-800">Riwayat Laporan Anda</h2>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-500 text-xs uppercase tracking-wider border-b border-gray-200">
                            <th class="py-3 px-4 font-semibold">No</th>
                            <th class="py-3 px-4 font-semibold">Tanggal</th>
                            <th class="py-3 px-4 font-semibold">Isi Laporan</th>
                            <th class="py-3 px-4 font-semibold">Status</th>
                            <th class="py-3 px-4 font-semibold text-center">Aksi</th> 
                        </tr>
                    </thead>
                    
                    <tbody class="divide-y divide-gray-100">
                        @foreach($pengaduan as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-4 text-sm">{{ $index + 1 }}</td>
                            <td class="py-4 px-4 text-sm">{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->format('d M Y') }}</td>
                            <td class="py-4 px-4 text-sm"><p class="truncate w-48">{{ $item->isi_laporan }}</p></td>
                            <td class="py-4 px-4 text-sm text-green-600 font-bold">{{ ucfirst($item->status) }}</td>
                            <td class="py-4 px-4 text-center">
                                <a href="{{ route('masyarakat.detail', $item->id_pengaduan) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-xs font-bold hover:bg-blue-600">
                                    Lihat Respon
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>