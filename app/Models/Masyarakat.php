<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    use Notifiable;

    protected $table = 'masyarakat';
    protected $primaryKey = 'nik'; // Beri tahu Laravel PK-nya nik
    public $incrementing = false;  // Beri tahu nik bukan angka auto-increment
    protected $keyType = 'string'; // Beri tahu nik itu string/char

    protected $fillable = [
        'nik', 'nama', 'username', 'password', 'telp',
    ];

    protected $hidden = [
        'password',
    ];
}