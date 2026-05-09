<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h2>Edit Jadwal Latihan</h2>
        <a href="/admin/jadwal" class="link-back">&larr; Kembali ke Daftar Jadwal</a>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-top: 20px;">
            <form action="/admin/jadwal/{{ $jadwal->id }}" method="POST">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 15px;">
                    <label class="form-label">Hari</label>
                    <select name="hari" class="form-input" required>
                        <option value="Senin" {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ $jadwal->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                        <option value="Minggu" {{ $jadwal->hari == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                    </select>
                </div>
                <div style="margin-bottom: 15px; display: flex; gap: 15px;">
                    <div style="flex:1;">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-input" value="{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}" required>
                    </div>
                    <div style="flex:1;">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-input" value="{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}" required>
                    </div>
                </div>
                <div style="margin-bottom: 15px;">
                    <label class="form-label">Tempat</label>
                    <input type="text" name="tempat" class="form-input" value="{{ $jadwal->tempat }}" required>
                </div>
                <button type="submit" class="btn bg-blue">Perbarui Jadwal</button>
            </form>
        </div>
    </div>
</body>
</html>
