<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - Pengaduan Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <nav class="bg-blue-700 p-4 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-user-shield text-2xl"></i>
                <h1 class="text-xl font-bold">Panel Admin / Petugas</h1>
            </div>
            <div class="flex items-center space-x-6">
                <span class="hidden md:inline text-sm">Selamat Datang, <strong>Admin</strong></span>
                <form action="{{ route('logout-petugas') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-sm font-semibold transition duration-200">
                        <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-10 px-4">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Laporan Masyarakat</h2>
            <a href="{{ route('laporan.cetak') }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition font-semibold">
                <i class="fas fa-print mr-2"></i> Cetak Laporan
            </a>
        </div>

        @if(session('status'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('status') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">NIK</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Isi Laporan</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pengaduan as $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-800">
                                {{ $item->nik }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-700 truncate w-64">{{ $item->isi_laporan }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status == '0')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">Menunggu</span>
                                @elseif($item->status == 'proses')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">Proses</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">Selesai</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('petugas.show', $item->id_pengaduan) }}" 
                                   class="inline-flex items-center px-4 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700 transition">
                                    <i class="fas fa-reply mr-2"></i> Tanggapi
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                Belum ada laporan masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 text-center text-gray-400 text-xs pb-10">
            &copy; 2026 Aplikasi Pengaduan Masyarakat
        </div>
    </div>

</body>
</html>