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
        'nama', 'foto', 'tempat_lahir', 'tanggal_lahir', 'berat_badan', 
        'tinggi_badan', 'nama_ayah', 'no_hp_ayah', 'nama_ibu', 
        'no_hp_ibu', 'alamat', 'ukuran_baju', 'sabuk', 'status', 'tanggal_diterima', 'tanggal_dinonaktifkan'
    ];

    public function setNoHpAyahAttribute($value)
    {
        $val = (string) $value;
        if (str_starts_with($val, '0')) {
            $this->attributes['no_hp_ayah'] = '+62' . substr($val, 1);
        } elseif (str_starts_with($val, '62')) {
            $this->attributes['no_hp_ayah'] = '+' . $val;
        } else {
            $this->attributes['no_hp_ayah'] = $val;
        }
    }

    public function setNoHpIbuAttribute($value)
    {
        $val = (string) $value;
        if (str_starts_with($val, '0')) {
            $this->attributes['no_hp_ibu'] = '+62' . substr($val, 1);
        } elseif (str_starts_with($val, '62')) {
            $this->attributes['no_hp_ibu'] = '+' . $val;
        } else {
            $this->attributes['no_hp_ibu'] = $val;
        }
    }

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