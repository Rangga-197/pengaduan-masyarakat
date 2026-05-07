@extends('layouts.app')

@section('content')
<nav class="bg-blue-900 text-white py-4 px-6 shadow-lg flex justify-between items-center sticky top-0 z-50">
    <div class="flex items-center gap-2">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
        <span class="font-bold text-xl tracking-tight">LaporPak!</span>
    </div>
    <div class="flex items-center gap-4">
        <span class="hidden md:block font-medium">Hallo, {{ auth()->user()->nama }}!</span>
        <a href="/logout" class="bg-red-500 hover:bg-red-600 p-2 rounded-full transition" title="Logout">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
        </a>
    </div>
</nav>

<div class="max-w-4xl mx-auto p-6">
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex items-center justify-between" role="alert">
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    </div>
    @endif
    
    <div class="bg-white rounded-2xl shadow-md p-8 mb-8 border-t-4 border-blue-900">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Buat Laporan Baru</h2>
        <form action="/laporan/kirim" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Kategori Laporan</label>
                    <select name="kategori" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-900 outline-none">
                        <option value="Infrastruktur">Infrastruktur</option>
                        <option value="Kesehatan">Kesehatan</option>
                        <option value="Keamanan">Keamanan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Lokasi Kejadian</label>
                    <input type="text" name="lokasi" placeholder="Contoh: Jl. Merdeka No. 1" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-900 outline-none" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Isi Laporan</label>
                <textarea name="isi_laporan" rows="4" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-900 outline-none" placeholder="Ceritakan detail kejadian..." required></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Foto Pendukung</label>
                <input type="file" name="foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                Kirim Laporan Sekarang
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mt-6">
        <div class="p-6 border-b border-gray-100 bg-gray-50">
            <h2 class="text-xl font-bold text-gray-800">Riwayat Laporan Anda</h2>
        </div>
        
        <div class="p-6 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-500 text-xs uppercase tracking-wider border-b border-gray-200">
                        <th class="py-3 px-4 font-semibold">NO</th>
                        <th class="py-3 px-4 font-semibold">TANGGAL</th>
                        <th class="py-3 px-4 font-semibold">KATEGORI</th>
                        <th class="py-3 px-4 font-semibold">STATUS</th>
                        <th class="py-3 px-4 font-semibold text-center">AKSI</th> 
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($laporanku as $index => $item)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="py-4 px-4 text-sm text-gray-700">
                            {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->format('d M Y') }}
                        </td>
                        <td class="py-4 px-4 text-sm text-gray-700">{{ $item->kategori }}</td>
                        <td class="py-4 px-4">
                            @if($item->status == '0')
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">Menunggu</span>
                            @elseif($item->status == 'proses')
                                <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-semibold">Proses</span>
                            @else
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Selesai</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-center">
                            <a href="{{ route('masyarakat.detail', $item->id_pengaduan) }}" 
                               class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-xs font-bold transition shadow-sm">
                                Lihat Respon
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-10 px-4 text-center text-gray-500 font-medium">
                            Belum ada laporan yang Anda kirim.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection