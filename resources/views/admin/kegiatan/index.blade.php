<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kegiatan - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h2>Kelola Kegiatan</h2>
        <a href="/dashboard" class="link-back">&larr; Kembali ke Dashboard Utama</a>

        @if(session('success'))
            <div class="alert-success" style="font-weight: bold; margin-bottom: 20px; color: #27ae60; background: #e8f8f5; padding: 10px; border-radius: 5px;">✓ {{ session('success') }}</div>
        @endif

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3 style="color: #2c3e50; margin: 0;">📅 Daftar Kegiatan</h3>
            <a href="/admin/kegiatan/create" class="btn bg-green" style="text-decoration: none; padding: 10px 15px; font-size: 14px; display: inline-block;">
                + Tambah Kegiatan
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table>
                <tr>
                    <th>Judul</th>
                    <th>Tgl Acara</th>
                    <th>Lokasi</th>
                    <th>Cover / Flyer</th>
                    <th>Aksi</th>
                </tr>
                @forelse($kegiatans as $kegiatan)
                <tr class="data-row">
                    <td><strong>{{ $kegiatan->title }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($kegiatan->event_date)->format('d M Y') }}</td>
                    <td>{{ $kegiatan->location ?? '-' }}</td>
                    <td>
                        @if($kegiatan->flyer_image)
                            <img src="{{ Storage::url($kegiatan->flyer_image) }}" alt="Cover" style="height: 50px; border-radius: 4px;">
                        @else
                            <span style="color: #999;">Tidak ada</span>
                        @endif
                    </td>
                    <td>
                        <a href="/admin/kegiatan/{{ $kegiatan->id }}/edit" class="btn bg-blue" style="text-decoration: none; display: inline-block;">Edit</a>
                        
                        <form action="/admin/kegiatan/{{ $kegiatan->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus kegiatan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn bg-red" style="margin-top: 5px;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: #7f8c8d;">Belum ada kegiatan.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</body>
</html>
