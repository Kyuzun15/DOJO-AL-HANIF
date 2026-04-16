<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama', 'tempat_lahir', 'tanggal_lahir', 'berat_badan', 
        'tinggi_badan', 'nama_ayah', 'no_hp_ayah', 'nama_ibu', 
        'no_hp_ibu', 'alamat', 'sabuk', 'status', 'tanggal_diterima', 'tanggal_dinonaktifkan'
    ];

    protected $casts = [
        'tanggal_diterima' => 'datetime',
        'tanggal_dinonaktifkan' => 'datetime',
        'tanggal_lahir' => 'date',
    ];

    // Relasi ke tabel Prestasi (1 Anggota bisa punya Banyak Prestasi)
    public function prestasi()
    {
        return $this->hasMany(PrestasiMember::class);
    }
}