@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-blue-900 p-6 text-center">
            <svg class="w-12 h-12 mx-auto text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
            <h1 class="text-2xl font-bold text-white">LaporPak!</h1>
            <p class="text-blue-200 text-sm mt-1">Sistem Pengaduan Masyarakat</p>
        </div>
        
        <div class="p-8">
            <form action="/login" method="POST">
                @csrf
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                    <input name="username" class="w-full px-4 py-3 rounded-lg border focus:border-blue-900 focus:ring-1 focus:ring-blue-900 outline-none transition" id="username" type="text" placeholder="Masukkan username" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                    <input name="password" class="w-full px-4 py-3 rounded-lg border focus:border-blue-900 focus:ring-1 focus:ring-blue-900 outline-none transition" id="password" type="password" placeholder="Masukkan password" required>
                </div>
                <button class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-lg transition duration-200" type="submit">
                    Masuk
                </button>
            </form>
            <p class="text-center text-sm text-gray-600 mt-6">
                Belum punya akun? <a href="/register" class="text-blue-900 font-bold hover:underline">Klik disini untuk daftar</a>
            </p>
        </div>
    </div>
</div>
@endsection