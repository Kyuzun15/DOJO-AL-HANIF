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

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); min-width: 600px;">
                <tr style="background: #f4f4f4;">
                    <th style="padding: 10px; border: 1px solid #ddd;">Hari</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Jam</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Tempat</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Aksi</th>
                </tr>
                @foreach($jadwals as $jadwal)
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $jadwal->hari }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $jadwal->tempat }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        <a href="/admin/jadwal/{{ $jadwal->id }}/edit" class="btn bg-blue">Edit</a>
                        <form action="/admin/jadwal/{{ $jadwal->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus jadwal ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn bg-red">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
</html>
