@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-center justify-center p-4 py-10">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-blue-900 p-6 text-center">
            <h1 class="text-2xl font-bold text-white">Daftar Akun Baru</h1>
            <p class="text-blue-200 text-sm mt-1">Lengkapi data diri Anda untuk melapor</p>
        </div>
        
        <div class="p-8">
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong>Waduh, ada yang salah:</strong>
                    <ul class="mt-2 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">NIK</label>
                    <input name="nik" class="w-full px-4 py-3 rounded-lg border focus:border-blue-900 outline-none" type="number" placeholder="Masukkan 16 digit NIK" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <input name="nama" class="w-full px-4 py-3 rounded-lg border focus:border-blue-900 outline-none" type="text" placeholder="Masukkan nama sesuai KTP" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input name="username" class="w-full px-4 py-3 rounded-lg border focus:border-blue-900 outline-none" type="text" placeholder="Buat username unik" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">No. Telepon</label>
                    <input name="telp" class="w-full px-4 py-3 rounded-lg border focus:border-blue-900 outline-none" type="number" placeholder="Contoh: 08123456789" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input name="password" class="w-full px-4 py-3 rounded-lg border focus:border-blue-900 outline-none" type="password" placeholder="Buat password minimal 6 karakter" required>
                </div>
                
                <button class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-lg transition" type="submit">
                    Konfirmasi Akun
                </button>
            </form>
            <p class="text-center text-sm text-gray-600 mt-6">
                Sudah punya akun? <a href="/login" class="text-blue-900 font-bold hover:underline">Masuk disini</a>
            </p>
        </div>
    </div>
</div>
@endsection