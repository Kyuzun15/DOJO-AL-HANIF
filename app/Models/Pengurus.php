<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_jabatan',
        'nama_lengkap',
        'tingkatan',
        'nama_jabatan',
        'foto',
        'periode',
        'prestasi_lomba',
        'prestasi_sertifikasi',
    ];
}
