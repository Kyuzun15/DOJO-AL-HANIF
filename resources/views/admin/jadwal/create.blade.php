<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h2>Tambah Jadwal Latihan</h2>
        <a href="/admin/jadwal" class="link-back">&larr; Kembali ke Daftar Jadwal</a>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-top: 20px;">
            <form action="/admin/jadwal" method="POST">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label class="form-label">Hari</label>
                    <select name="hari" class="form-input" required>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>
                <div style="margin-bottom: 15px; display: flex; gap: 15px;">
                    <div style="flex:1;">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-input" required>
                    </div>
                    <div style="flex:1;">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-input" required>
                    </div>
                </div>
                <div style="margin-bottom: 15px;">
                    <label class="form-label">Tempat</label>
                    <input type="text" name="tempat" class="form-input" required>
                </div>
                <button type="submit" class="btn bg-blue">Simpan Jadwal</button>
            </form>
        </div>
    </div>
</body>
</html>
