<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberProfileController extends Controller
{
    public function index()
    {
        $members = Member::where('status', 'aktif')->orderBy('nama', 'asc')->get();

        $beltOrder = [
            'SABUK HITAM',
            'SABUK COKLAT',
            'SABUK UNGU',
            'SABUK BIRU',
            'SABUK HIJAU',
            'SABUK KUNING',
            'SABUK PUTIH',
            'BELUM PUNYA SABUK',
        ];

        $groupedMembers = [];
        foreach ($beltOrder as $belt) {
            $groupedMembers[$belt] = [];
        }

        foreach ($members as $member) {
            $sabukFull = $member->sabuk;
            if (str_contains($sabukFull, ' - ')) {
                $parts = explode(' - ', $sabukFull);
                $tingkatan = $parts[0];
                $warna = $parts[1];
                
                if (isset($groupedMembers[$warna])) {
                    $member->tingkatan_sabuk = $tingkatan;
                    $groupedMembers[$warna][] = $member;
                }
            } elseif ($sabukFull === 'Belum punya sabuk' || $sabukFull === null) {
                $member->tingkatan_sabuk = '-';
                if (isset($groupedMembers['BELUM PUNYA SABUK'])) {
                    $groupedMembers['BELUM PUNYA SABUK'][] = $member;
                }
            }
        }

        // Filter out empty groups
        foreach ($groupedMembers as $belt => $list) {
            if (count($list) === 0) {
                unset($groupedMembers[$belt]);
            }
        }

        return view('profil', compact('groupedMembers'));
    }

    public function show($id)
    {
        $member = Member::with('prestasi')->findOrFail($id);
        
        // Extract year from tanggal_diterima
        $member->tahun_masuk = $member->tanggal_diterima ? $member->tanggal_diterima->format('Y') : '-';
        
        $total_hadir = \App\Models\Absensi::where('member_id', $member->id)->where('status', 'hadir')->count();
        
        return view('show-member', compact('member', 'total_hadir'));
    }
}
