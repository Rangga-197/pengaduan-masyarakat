<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class PetugasController extends Controller
{
    // 1. Menampilkan halaman login
    public function showLoginForm()
    {
        return view('login-petugas');
    }

    // 2. Proses Login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('petugas')->attempt($request->only('username', 'password'))) {
            return redirect()->intended('/dashboard-petugas');
        }

        return back()->withErrors(['error' => 'Username atau Password salah!']);
    }

    // 3. Menampilkan Dashboard
    public function index()
    {
        $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();
        return view('dashboard-petugas', compact('pengaduan'));
    }

    // 4. Detail Laporan
    public function show($id)
    {
        $item = Pengaduan::findOrFail($id);
        return view('detail-pengaduan', compact('item'));
    }

    // 5. Tanggapan
    public function tanggapi(Request $request)
    {
        Tanggapan::create([
            'id_pengaduan' => $request->id_pengaduan,
            'tgl_tanggapan' => date('Y-m-d'),
            'tanggapan' => $request->tanggapan,
            'id_petugas' => Auth::guard('petugas')->user()->id_petugas,
        ]);

        $pengaduan = Pengaduan::findOrFail($request->id_pengaduan);
        $pengaduan->update(['status' => $request->status]);

        return redirect()->route('dashboard-petugas')->with('status', 'Laporan berhasil ditanggapi!');
    }

    // 6. Cetak Laporan (Fungsi yang tadi eror)
    public function cetakLaporan()
    {
        $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();
        return view('laporan-cetak', compact('pengaduan'));
    }

    // 7. Logout
    public function logout()
    {
        Auth::guard('petugas')->logout();
        return redirect('/login-petugas');
    }
}