<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Fungsi untuk memproses pendaftaran
    public function proses_register(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'nik' => 'required|size:16|unique:masyarakat,nik',
            'nama' => 'required',
            'username' => 'required|unique:masyarakat,username',
            'telp' => 'required|max:13',
            'password' => 'required|min:6',
        ]);

        // 2. Simpan ke database
        Masyarakat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'telp' => $request->telp,
            'password' => Hash::make($request->password), 
        ]);

        // 3. Pindah ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }

    // Fungsi untuk memproses login (YANG TADI HILANG)
    public function proses_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari data masyarakat berdasarkan username
        $masyarakat = Masyarakat::where('username', $request->username)->first();

        // Jika username ketemu DAN password-nya cocok
        if ($masyarakat && Hash::check($request->password, $masyarakat->password)) {
            // Berhasil login, simpan sesi
            Auth::login($masyarakat);
            return redirect('/dashboard');
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->with('error', 'Username atau Password salah!');
    }

    // Fungsi untuk logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}