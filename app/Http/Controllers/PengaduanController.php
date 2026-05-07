<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    // Fungsi untuk menyimpan laporan baru
    public function simpan_laporan(Request $request)
    {
        // 1. Validasi inputan
        $request->validate([
            'kategori' => 'required',
            'lokasi' => 'required',
            'isi_laporan' => 'required',
            // Pastikan yang diupload benar-benar file gambar dan ukurannya maksimal 2MB
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        // 2. Proses upload foto (jika ada)
        $nama_foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            // Buat nama unik agar tidak bentrok (gabungan waktu + nama asli)
            $nama_foto = time() . "_" . $foto->getClientOriginalName();
            // Simpan foto ke dalam folder public/images
            $foto->move(public_path('images'), $nama_foto);
        }

        // 3. Simpan data ke database
        Pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d'), // Tanggal hari ini otomatis
            'nik' => Auth::user()->nik,       // Ambil NIK dari user yang sedang login
            'isi_laporan' => $request->isi_laporan,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'foto' => $nama_foto,
            'status' => '0', // Status awal: 0 (Belum diproses)
        ]);

        // 4. Kembalikan ke halaman dashboard dengan pesan sukses
        return back()->with('success', 'Mantap! Laporan kamu berhasil dikirim.');
    }
}