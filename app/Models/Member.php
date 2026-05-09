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
        'no_hp_ibu', 'alamat', 'ukuran_baju', 'sabuk', 'status', 'tanggal_diterima', 'tanggal_dinonaktifkan', 'nomor_anggota'
    ];

    public static function generateNomorAnggota()
    {
        // Format: DAH-TAHUN-0001
        $tahun = date('Y');
        $lastMember = self::where('nomor_anggota', 'like', "DAH-{$tahun}-%")->orderBy('id', 'desc')->first();
        
        if ($lastMember && $lastMember->nomor_anggota) {
            $parts = explode('-', $lastMember->nomor_anggota);
            if (count($parts) == 3) {
                $lastNumber = intval($parts[2]);
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }
        } else {
            $nextNumber = 1;
        }

        return 'DAH-' . $tahun . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

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

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}