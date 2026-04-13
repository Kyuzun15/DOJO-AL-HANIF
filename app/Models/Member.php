<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'members';

    // Kolom yang boleh diisi
    // Pastikan 'tanggal_diterima' masuk di sini agar bisa diisi saat proses pindah data
    protected $fillable = [
        'nama_lengkap',
        'no_whatsapp',
        'umur',
        'sabuk',
        'tanggal_diterima',
    ];

    /**
     * Casting kolom tanggal_diterima agar otomatis menjadi objek Carbon/Date 
     * sehingga mudah dimanipulasi (format tanggal dsb).
     */
    protected $casts = [
        'tanggal_diterima' => 'datetime',
    ];
}