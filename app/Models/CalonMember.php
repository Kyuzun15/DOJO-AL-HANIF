<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonMember extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara spesifik (opsional jika nama file sudah jamak)
    protected $table = 'calon_members';

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama', 'tempat_lahir', 'tanggal_lahir', 'berat_badan', 
        'tinggi_badan', 'nama_ayah', 'no_hp_ayah', 'nama_ibu', 
        'no_hp_ibu', 'alamat'
    ];
}