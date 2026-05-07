<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Penting agar bisa login

class Petugas extends Authenticatable
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $fillable = ['nama_petugas', 'username', 'password', 'telp', 'level'];

    // Relasi: Petugas bisa memberikan banyak tanggapan
    public function tanggapan() {
        return $this->hasMany(Tanggapan::class, 'id_petugas');
    }
}
