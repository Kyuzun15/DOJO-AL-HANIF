<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiMember extends Model
{
    use HasFactory;

    protected $table = 'prestasi_members';

    protected $fillable = [
        'member_id',
        'nama_prestasi',
        'foto_prestasi',
    ];

    // Relasi balik ke Member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}