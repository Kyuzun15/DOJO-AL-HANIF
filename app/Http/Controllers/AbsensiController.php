<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal', date('Y-m-d'));
        
        $members = Member::where('status', 'Aktif')->get();
        $absensi = Absensi::where('tanggal', $tanggal)->get()->keyBy('member_id');

        return view('admin.absensi.index', compact('members', 'tanggal', 'absensi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'status' => 'required|array',
        ]);

        $tanggal = $request->tanggal;

        foreach ($request->status as $member_id => $status) {
            Absensi::updateOrCreate(
                ['member_id' => $member_id, 'tanggal' => $tanggal],
                ['status' => $status]
            );
        }

        return back()->with('success', 'Absensi berhasil disimpan!');
    }

    public function rekap(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $members = Member::where('status', 'Aktif')->get();
        $absensi = Absensi::whereMonth('tanggal', $bulan)
                          ->whereYear('tanggal', $tahun)
                          ->get();

        $rekap = [];
        foreach ($members as $member) {
            $memberAbsensi = $absensi->where('member_id', $member->id);
            
            $getDates = function($status) use ($memberAbsensi) {
                return $memberAbsensi->where('status', $status)
                    ->pluck('tanggal')
                    ->map(fn($d) => \Carbon\Carbon::parse($d)->format('d'))
                    ->implode(', ');
            };

            $rekap[] = [
                'nama' => $member->nama,
                'sabuk' => $member->sabuk,
                'hadir' => $memberAbsensi->where('status', 'hadir')->count(),
                'izin' => $memberAbsensi->where('status', 'izin')->count(),
                'sakit' => $memberAbsensi->where('status', 'sakit')->count(),
                'alfa' => $memberAbsensi->where('status', 'alfa')->count(),
                'detail_hadir' => $getDates('hadir'),
                'detail_izin' => $getDates('izin'),
                'detail_sakit' => $getDates('sakit'),
                'detail_alfa' => $getDates('alfa'),
            ];
        }

        return view('admin.absensi.rekap', compact('rekap', 'bulan', 'tahun'));
    }

    public function export(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $members = Member::where('status', 'Aktif')->get();
        $absensi = Absensi::whereMonth('tanggal', $bulan)
                          ->whereYear('tanggal', $tahun)
                          ->get();

        $filename = "rekap_absensi_{$bulan}_{$tahun}.csv";
        
        $callback = function() use ($members, $absensi) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['No', 'Nama Anggota', 'Sabuk', 'Hadir', 'Tgl Hadir', 'Izin', 'Tgl Izin', 'Sakit', 'Tgl Sakit', 'Alfa', 'Tgl Alfa']);
            
            $no = 1;
            foreach ($members as $member) {
                $memberAbsensi = $absensi->where('member_id', $member->id);
                
                $getDates = function($status) use ($memberAbsensi) {
                    return $memberAbsensi->where('status', $status)
                        ->pluck('tanggal')
                        ->map(fn($d) => \Carbon\Carbon::parse($d)->format('d'))
                        ->implode(', ');
                };

                fputcsv($handle, [
                    $no++,
                    $member->nama,
                    $member->sabuk,
                    $memberAbsensi->where('status', 'hadir')->count(),
                    $getDates('hadir'),
                    $memberAbsensi->where('status', 'izin')->count(),
                    $getDates('izin'),
                    $memberAbsensi->where('status', 'sakit')->count(),
                    $getDates('sakit'),
                    $memberAbsensi->where('status', 'alfa')->count(),
                    $getDates('alfa'),
                ]);
            }
            fclose($handle);
        };

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->stream($callback, 200, $headers);
    }
}
