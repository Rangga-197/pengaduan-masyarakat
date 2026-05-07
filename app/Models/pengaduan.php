<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    // Beri tahu Laravel nama tabelnya
    protected $table = 'pengaduan';
    
    // Beri tahu Laravel primary key-nya
    protected $primaryKey = 'id_pengaduan';
    
    // Izinkan kolom-kolom ini diisi data dari form
    protected $fillable = [
        'tgl_pengaduan', 
        'nik', 
        'kategori', 
        'lokasi', 
        'isi_laporan', 
        'foto', 
        'status'
    ];

    public function tanggapan()
{
    // Ini memberitahu Laravel bahwa satu pengaduan punya satu tanggapan
    return $this->hasOne(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
}
}