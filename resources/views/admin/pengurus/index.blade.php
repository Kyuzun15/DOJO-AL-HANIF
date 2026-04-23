<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengurus - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h2>Kelola Struktur Organisasi</h2>
        <a href="/dashboard" class="link-back">&larr; Kembali ke Dashboard Utama</a>

        @if(session('success'))
            <div class="alert-success" style="font-weight: bold; margin-bottom: 20px; color: #27ae60; background: #e8f8f5; padding: 10px; border-radius: 5px;">✓ {{ session('success') }}</div>
        @endif

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3 style="color: #2c3e50; margin: 0;">👥 Daftar Pengurus</h3>
            <a href="/admin/pengurus/create" class="btn bg-green" style="text-decoration: none; padding: 10px 15px; font-size: 14px; display: inline-block;">
                + Tambah Pengurus
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table>
                <tr>
                    <th>Kode Jabatan</th>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>Periode</th>
                    <th>Aksi</th>
                </tr>
                @forelse($pengurus as $p)
                <tr class="data-row">
                    <td><code>{{ $p->kode_jabatan }}</code></td>
                    <td><strong>{{ $p->nama_lengkap }}</strong><br><small>{{ $p->tingkatan }}</small></td>
                    <td>{{ $p->nama_jabatan }}</td>
                    <td>{{ $p->periode }}</td>
                    <td>
                        <a href="/admin/pengurus/{{ $p->id }}/edit" class="btn bg-blue" style="text-decoration: none; display: inline-block;">Edit</a>
                        
                        <form action="/admin/pengurus/{{ $p->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus data pengurus ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn bg-red">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: #7f8c8d;">Belum ada data pengurus.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</body>
</html>
