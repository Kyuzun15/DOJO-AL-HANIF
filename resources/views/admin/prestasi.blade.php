<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi - {{ $member->nama }}</title>
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: auto; }
        .header-card { background: white; padding: 20px 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;}
        .header-info h2 { margin: 0; color: #2c3e50; }
        .header-info p { margin: 5px 0 0 0; color: #7f8c8d; }
        .btn-back { display: inline-block; padding: 8px 15px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .btn-back:hover { background: #c0392b; }
        
        .alert-success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
        
        /* Form Tambah */
        .form-card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 30px; border-top: 4px solid #27ae60; }
        .form-input { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 5px; }
        .btn-submit { background: #27ae60; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%; font-size: 16px;}
        
        /* Grid Galeri */
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .prestasi-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); text-align: center; border: 1px solid #eee;}
        .prestasi-img { width: 100%; height: 200px; object-fit: cover; background: #f8f9fa; }
        .prestasi-body { padding: 15px; }
        .prestasi-title { font-weight: bold; font-size: 15px; color: #333; margin-bottom: 15px; }
        .btn-delete { background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-size: 13px; width: 100%; }
        
        .no-data { text-align: center; color: #7f8c8d; padding: 40px; background: white; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header-card">
            <div class="header-info">
                <h2>🏆 Galeri Prestasi</h2>
                <p><strong>{{ $member->nama }}</strong> — {{ $member->sabuk }}</p>
            </div>
            <a href="/dashboard" class="btn-back">&larr; Kembali ke Dashboard</a>
        </div>

        @if(session('success')) <div class="alert-success">{{ session('success') }}</div> @endif
        @if($errors->any()) <div class="alert-success" style="background:#f8d7da; color:#721c24;">Gagal upload! Pastikan file berupa gambar (jpg/png) max 2MB.</div> @endif

        <div class="form-card">
            <h3 style="margin-top:0; color:#27ae60;">+ Tambah Medali / Sertifikat Baru</h3>
            <form action="/admin/anggota/{{ $member->id }}/prestasi" method="POST" enctype="multipart/form-data">
                @csrf
                <label style="font-weight:bold;">Nama Kejuaraan / Pencapaian</label>
                <input type="text" name="nama_prestasi" class="form-input" placeholder="Cth: Juara 1 Kumite O2SN 2024" required>
                
                <label style="font-weight:bold;">Upload Foto Bukti (Maks 2MB)</label>
                <input type="file" name="foto_prestasi" class="form-input" accept="image/*">
                
                <button type="submit" class="btn-submit">Simpan Prestasi</button>
            </form>
        </div>

        @if($member->prestasi->count() > 0)
            <div class="gallery-grid">
                @foreach($member->prestasi as $pres)
                <div class="prestasi-card">
                    @if($pres->foto_prestasi)
                        <a href="{{ asset('storage/' . $pres->foto_prestasi) }}" target="_blank">
                            <img src="{{ asset('storage/' . $pres->foto_prestasi) }}" class="prestasi-img" alt="Foto Prestasi">
                        </a>
                    @else
                        <div class="prestasi-img" style="display:flex; align-items:center; justify-content:center; color:#aaa;">(Tidak ada foto)</div>
                    @endif
                    
                    <div class="prestasi-body">
                        <div class="prestasi-title">{{ $pres->nama_prestasi }}</div>
                        <form action="/admin/prestasi/{{ $pres->id }}/hapus" method="POST" onsubmit="return confirm('Hapus prestasi ini permanen?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus Prestasi</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="no-data">
                <h2>📭</h2>
                <p>Belum ada data prestasi untuk anggota ini.</p>
            </div>
        @endif

    </div>
</body>
</html>