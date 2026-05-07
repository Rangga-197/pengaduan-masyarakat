<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;

class MasyarakatController extends Controller
{
    // 1. Menampilkan daftar laporan milik user yang sedang login
    public function index()
    {
        // Mengambil pengaduan berdasarkan NIK user yang login
        $pengaduan = Pengaduan::where('nik', Auth::user()->nik)->orderBy('tgl_pengaduan', 'desc')->get();
        
        return view('riwayat-laporan', compact('pengaduan'));
    }

    // 2. Menampilkan detail laporan beserta tanggapan petugas
    public function lihatTanggapan($id)
    {
        // Mengambil laporan beserta relasi tanggapan
        $item = Pengaduan::with('tanggapan')->findOrFail($id);
        
        return view('riwayat-detail', compact('item'));
    }
}