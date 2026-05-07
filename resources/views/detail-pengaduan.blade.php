<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow">
        <a href="{{ route('dashboard-petugas') }}" class="text-blue-600 hover:underline">← Kembali</a>
        <h2 class="text-2xl font-bold mt-4 mb-6">Detail Laporan</h2>

        <div class="mb-4">
            <label class="font-bold text-gray-600 block">Isi Laporan:</label>
            <p class="p-3 bg-gray-50 border rounded mt-1">{{ $item->isi_laporan }}</p>
        </div>

        @if($item->foto)
        <div class="mb-4">
            <label class="font-bold text-gray-600 block">Foto Bukti:</label>
            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Bukti" class="w-full max-w-md rounded mt-2 border">
        </div>
        @endif

        <hr class="my-8">

        <h3 class="text-xl font-bold mb-4">Berikan Tanggapan</h3>
        <form action="{{ route('petugas.tanggapi') }}" method="POST">
            @csrf
            <input type="hidden" name="id_pengaduan" value="{{ $item->id_pengaduan }}">
            
            <div class="mb-4">
                <label class="block text-gray-700">Pilih Status Akhir:</label>
                <select name="status" class="w-full p-2 border rounded mt-1">
                    <option value="proses">Proses</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Tulis Tanggapan:</label>
                <textarea name="tanggapan" rows="5" class="w-full p-2 border rounded mt-1" required placeholder="Tulis jawaban atau tindakan yang dilakukan..."></textarea>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded font-bold hover:bg-green-700">Kirim Tanggapan</button>
        </form>
    </div>
</body>
</html>