<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengurus - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h2>Tambah Pengurus Baru</h2>
        <a href="/admin/pengurus" class="link-back">&larr; Kembali ke Daftar Pengurus</a>

        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-top: 20px;">
            <form action="/admin/pengurus" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <label class="form-label">Pilih Jabatan</label>
                        <select name="kode_jabatan" class="form-input" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="ketua" {{ old('kode_jabatan') == 'ketua' ? 'selected' : '' }}>KETUA</option>
                            <option value="sekretaris" {{ old('kode_jabatan') == 'sekretaris' ? 'selected' : '' }}>SEKRETARIS</option>
                            <option value="bendahara" {{ old('kode_jabatan') == 'bendahara' ? 'selected' : '' }}>BENDAHARA</option>
                            <option value="bimbingan_prestasi" {{ old('kode_jabatan') == 'bimbingan_prestasi' ? 'selected' : '' }}>BIMBINGAN PRESTASI</option>
                            <option value="bidang_usaha" {{ old('kode_jabatan') == 'bidang_usaha' ? 'selected' : '' }}>BIDANG USAHA</option>
                            <option value="ukt_gasuku" {{ old('kode_jabatan') == 'ukt_gasuku' ? 'selected' : '' }}>UKT & GASUKU</option>
                        </select>
                        @error('kode_jabatan') <small style="color: red;">{{ $message }}</small> @enderror
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Tingkatan Sabuk</label>
                        <select name="tingkatan" class="form-input" required>
                            <option value="">-- Pilih Sabuk --</option>
                            <option value="Belum punya sabuk">Belum punya sabuk</option>
                            <option value="KYU VIII - SABUK PUTIH">KYU VIII - SABUK PUTIH</option>
                            <option value="KYU VII - SABUK KUNING">KYU VII - SABUK KUNING</option>
                            <option value="KYU VI - SABUK HIJAU">KYU VI - SABUK HIJAU</option>
                            <option value="KYU V - SABUK BIRU">KYU V - SABUK BIRU</option>
                            <option value="KYU IV - SABUK UNGU">KYU IV - SABUK UNGU</option>
                            <option value="KYU III - SABUK COKLAT">KYU III - SABUK COKLAT</option>
                            <option value="KYU II - SABUK COKLAT">KYU II - SABUK COKLAT</option>
                            <option value="KYU I - SABUK COKLAT">KYU I - SABUK COKLAT</option>
                            <option value="DAN I - SABUK HITAM">DAN I - SABUK HITAM</option>
                            <option value="DAN II - SABUK HITAM">DAN II - SABUK HITAM</option>
                            <option value="DAN III - SABUK HITAM">DAN III - SABUK HITAM</option>
                            <option value="DAN IV - SABUK HITAM">DAN IV - SABUK HITAM</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-input" placeholder="Nama lengkap pengurus" value="{{ old('nama_lengkap') }}" required>
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Sub Jabatan (Opsional)</label>
                        <input type="text" name="sub_jabatan" class="form-input" placeholder="Contoh: Ketua Divisi, Anggota" value="{{ old('sub_jabatan') }}">
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Periode</label>
                        <input type="text" name="periode" class="form-input" placeholder="contoh: 2024 - 2027" value="{{ old('periode') }}" required>
                    </div>
                </div>

                <div style="margin-bottom: 15px;">
                    <label class="form-label">Foto Pengurus</label>
                    <input type="file" name="foto" class="form-input" accept="image/*">
                </div>

                <div style="margin-bottom: 15px;">
                    <label class="form-label">Prestasi Lomba</label>
                    <textarea name="prestasi_lomba" class="form-input" rows="3" placeholder="Pisahkan dengan baris baru atau koma">{{ old('prestasi_lomba') }}</textarea>
                </div>

                <div style="margin-bottom: 15px;">
                    <label class="form-label">Prestasi Sertifikasi</label>
                    <textarea name="prestasi_sertifikasi" class="form-input" rows="3" placeholder="Pisahkan dengan baris baru atau koma">{{ old('prestasi_sertifikasi') }}</textarea>
                </div>

                <div style="margin-top: 25px;">
                    <button type="submit" class="btn bg-blue" style="width: 100%; padding: 12px; font-size: 16px;">Simpan Data Pengurus</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
