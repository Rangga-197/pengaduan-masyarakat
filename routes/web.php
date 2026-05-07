<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Ini sangat penting agar AuthController terbaca!
use App\Http\Controllers\PengaduanController;
use App\Models\Pengaduan;

// Menampilkan halaman (GET)
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login'); 

Route::get('/register', function () {
    return view('auth.register');
});


// --- KODE BARU DIMULAI DARI SINI ---

// Memproses data yang dikirim dari form (POST)
// ... rute-rute lainnya di atas ...

// Memproses data yang dikirim dari form (POST)
Route::post('/register', [AuthController::class, 'proses_register']);
Route::post('/login', [AuthController::class, 'proses_login']);

// Keluar dari akun (Logout)
Route::get('/logout', [AuthController::class, 'logout']);

// Halaman Dashboard Utama
Route::get('/dashboard', function () {
    // Ambil data pengaduan khusus milik masyarakat yang sedang login, urutkan dari yang terbaru
    $laporanku = Pengaduan::where('nik', auth()->user()->nik)
                          ->orderBy('tgl_pengaduan', 'desc')
                          ->get();
    
    // Kirim data $laporanku ke tampilan dashboard
    return view('dashboard', compact('laporanku')); 
})->middleware('auth');

// Route untuk memproses kiriman laporan (harus login)
Route::post('/laporan/kirim', [PengaduanController::class, 'simpan_laporan'])->middleware('auth');

Route::get('/dashboard', function () {
    // Ambil data laporan khusus milik user yang login
    $laporanku = App\Models\Pengaduan::where('nik', auth()->user()->nik)
                          ->orderBy('tgl_pengaduan', 'desc')
                          ->get();
    
    // Kirim data $laporanku ke halaman dashboard
    return view('dashboard', compact('laporanku')); 
})->middleware('auth');
Route::get('/riwayat-detail/{id}', [App\Http\Controllers\PetugasController::class, 'show'])->name('masyarakat.detail');

// Rute untuk Login Petugas
Route::get('/login-petugas', [App\Http\Controllers\PetugasController::class, 'showLoginForm'])->name('login-petugas');
Route::post('/login-petugas', [App\Http\Controllers\PetugasController::class, 'login']);
Route::post('/logout-petugas', [App\Http\Controllers\PetugasController::class, 'logout'])->name('logout-petugas');

Route::middleware('auth:petugas')->group(function () {
    // Rute dashboard yang sudah ada
    Route::get('/dashboard-petugas', [App\Http\Controllers\PetugasController::class, 'index'])->name('dashboard-petugas');
    // Tambahkan ini di dalam group middleware petugas
Route::get('/laporan/cetak', [App\Http\Controllers\PetugasController::class, 'cetakLaporan'])->name('laporan.cetak');
    
    // TAMBAHKAN DUA BARIS INI DI SINI:
    Route::get('/pengaduan/{id}', [App\Http\Controllers\PetugasController::class, 'show'])->name('petugas.show');
    Route::post('/tanggapan', [App\Http\Controllers\PetugasController::class, 'tanggapi'])->name('petugas.tanggapi');
});

Route::middleware('auth')->group(function () {
    Route::get('/riwayat-laporan', [App\Http\Controllers\MasyarakatController::class, 'index'])->name('masyarakat.riwayat');
    Route::get('/riwayat-detail/{id}', [App\Http\Controllers\MasyarakatController::class, 'lihatTanggapan'])->name('masyarakat.detail');
});