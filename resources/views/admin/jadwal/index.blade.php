<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Latihan</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h2>Daftar Jadwal Latihan</h2>
        <a href="/dashboard" class="link-back">&larr; Kembali ke Dashboard</a>
        <a href="/admin/jadwal/create" class="btn bg-blue" style="margin-bottom: 20px; display: inline-block;">Tambah Jadwal</a>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <style>
            .jadwal-timeline-wrapper {
                position: relative;
                user-select: none;
                width: 100%;
            }
            .jadwal-timeline {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                position: relative;
                width: 100%;
                min-width: 0;
                padding: 40px 0;
                margin: 0;
            }
            .jadwal-timeline .timeline-node {
                position: relative;
                z-index: 2;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
                padding-top: 30px;
            }
            .jadwal-timeline .timeline-node:nth-child(odd) {
                margin-top: 0;
            }
            .jadwal-timeline .timeline-node:nth-child(even) {
                margin-top: 50px;
            }
            .jadwal-timeline .timeline-day {
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                font-weight: bold;
                font-size: 0.85rem;
                color: #333;
                text-transform: uppercase;
                white-space: nowrap;
            }
            .jadwal-timeline .timeline-circle {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background-color: white;
                border: 3px solid #b31b1b;
                transition: all 0.3s ease;
            }
            .jadwal-timeline .timeline-circle.active {
                border-color: #0056b3;
                background-color: #0056b3;
                box-shadow: 0 0 10px rgba(0, 86, 179, 0.4);
            }
            .jadwal-timeline .timeline-times {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-top: 10px;
                min-height: 20px;
                gap: 15px;
            }
            .jadwal-timeline .timeline-time {
                font-size: 0.9rem;
                font-weight: bold;
                color: #0056b3;
                text-align: center;
                background: #f9f9f9;
                padding: 10px;
                border-radius: 8px;
                border: 1px solid #ddd;
                box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            }
            .jadwal-timeline .timeline-time.empty {
                background: transparent;
                border: none;
                box-shadow: none;
                color: #aaa;
            }
            .btn-xs {
                padding: 4px 8px;
                font-size: 0.7rem;
                border-radius: 4px;
            }
            @media (max-width: 600px) {
                .jadwal-timeline .timeline-day { font-size: 0.6rem; }
                .jadwal-timeline .timeline-circle { width: 20px; height: 20px; }
            }
        </style>

        <div class="jadwal-timeline-wrapper" style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 20px 10px; margin-top: 20px; overflow: hidden;">
            <div class="jadwal-timeline">
                <svg class="timeline-zigzag-line" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none;">
                    <!-- Circle top is 30px, height 30px. Center is 45px. Even offset is 50px. Center is 95px -->
                    <polyline points="7.14%,45 21.42%,95 35.71%,45 50%,95 64.28%,45 78.57%,95 92.85%,45" fill="none" stroke="#d32f2f" stroke-width="3" stroke-linejoin="round"/>
                </svg>
                @php
                    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                @endphp
                @foreach($days as $day)
                    @php
                        $jadwalHariIni = $jadwals->where('hari', $day);
                    @endphp
                    <div class="timeline-node">
                        <div class="timeline-day">{{ $day }}</div>
                        <div class="timeline-circle {{ $jadwalHariIni->isNotEmpty() ? 'active' : '' }}"></div>
                        <div class="timeline-times">
                            @if($jadwalHariIni->isNotEmpty())
                                @foreach($jadwalHariIni as $j)
                                    <div class="timeline-time">
                                        <div style="margin-bottom: 5px;">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H.i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H.i') }}</div>
                                        <div style="font-size: 0.75rem; color:#666; font-weight: normal; margin-bottom: 10px;">{{ $j->tempat }}</div>
                                        <div style="display: flex; gap: 5px; justify-content: center;">
                                            <a href="/admin/jadwal/{{ $j->id }}/edit" class="btn bg-blue btn-xs">Edit</a>
                                            <form action="/admin/jadwal/{{ $j->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus jadwal ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn bg-red btn-xs" style="border:none; cursor:pointer;">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="timeline-time empty">-</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
