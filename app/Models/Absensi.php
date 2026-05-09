<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'tanggal', 'status'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
