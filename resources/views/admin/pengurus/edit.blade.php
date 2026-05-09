<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengurus - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h2>Edit Data Pengurus</h2>
        <a href="/admin/pengurus" class="link-back">&larr; Kembali ke Daftar Pengurus</a>

        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-top: 20px;">
            <form action="/admin/pengurus/{{ $pengurus->id }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <label class="form-label">Jabatan</label>
                        <select name="kode_jabatan" class="form-input" required>
                            <option value="ketua" {{ old('kode_jabatan', $pengurus->kode_jabatan) == 'ketua' ? 'selected' : '' }}>KETUA</option>
                            <option value="bendahara" {{ old('kode_jabatan', $pengurus->kode_jabatan) == 'bendahara' ? 'selected' : '' }}>BENDAHARA</option>
                            <option value="sekretaris" {{ old('kode_jabatan', $pengurus->kode_jabatan) == 'sekretaris' ? 'selected' : '' }}>SEKRETARIS</option>
                            <option value="bimbingan_presiden_1" {{ old('kode_jabatan', $pengurus->kode_jabatan) == 'bimbingan_presiden_1' ? 'selected' : '' }}>BIMBINGAN PRESTASI (KETUA)</option>
                            <option value="bidang_usaha" {{ old('kode_jabatan', $pengurus->kode_jabatan) == 'bidang_usaha' ? 'selected' : '' }}>BIDANG USAHA</option>
                            <option value="bimbingan_presiden_2" {{ old('kode_jabatan', $pengurus->kode_jabatan) == 'bimbingan_presiden_2' ? 'selected' : '' }}>BIMBINGAN PRESTASI (WAKIL KETUA)</option>
                        </select>
                        @error('kode_jabatan') <small style="color: red;">{{ $message }}</small> @enderror
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Tingkatan Sabuk</label>
                        <select name="tingkatan" class="form-input" required>
                            <option value="Belum punya sabuk" {{ old('tingkatan', $pengurus->tingkatan) == 'Belum punya sabuk' ? 'selected' : '' }}>Belum punya sabuk</option>
                            <option value="KYU VIII - SABUK PUTIH" {{ old('tingkatan', $pengurus->tingkatan) == 'KYU VIII - SABUK PUTIH' ? 'selected' : '' }}>KYU VIII - SABUK PUTIH</option>
                            <option value="KYU VII - SABUK KUNING" {{ old('tingkatan', $pengurus->tingkatan) == 'KYU VII - SABUK KUNING' ? 'selected' : '' }}>KYU VII - SABUK KUNING</option>
                            <option value="KYU VI - SABUK HIJAU" {{ old('tingkatan', $pengurus->tingkatan) == 'KYU VI - SABUK HIJAU' ? 'selected' : '' }}>KYU VI - SABUK HIJAU</option>
                            <option value="KYU V - SABUK BIRU" {{ old('tingkatan', $pengurus->tingkatan) == 'KYU V - SABUK BIRU' ? 'selected' : '' }}>KYU V - SABUK BIRU</option>
                            <option value="KYU IV - SABUK UNGU" {{ old('tingkatan', $pengurus->tingkatan) == 'KYU IV - SABUK UNGU' ? 'selected' : '' }}>KYU IV - SABUK UNGU</option>
                            <option value="KYU III - SABUK COKLAT" {{ old('tingkatan', $pengurus->tingkatan) == 'KYU III - SABUK COKLAT' ? 'selected' : '' }}>KYU III - SABUK COKLAT</option>
                            <option value="KYU II - SABUK COKLAT" {{ old('tingkatan', $pengurus->tingkatan) == 'KYU II - SABUK COKLAT' ? 'selected' : '' }}>KYU II - SABUK COKLAT</option>
                            <option value="KYU I - SABUK COKLAT" {{ old('tingkatan', $pengurus->tingkatan) == 'KYU I - SABUK COKLAT' ? 'selected' : '' }}>KYU I - SABUK COKLAT</option>
                            <option value="DAN I - SABUK HITAM" {{ old('tingkatan', $pengurus->tingkatan) == 'DAN I - SABUK HITAM' ? 'selected' : '' }}>DAN I - SABUK HITAM</option>
                            <option value="DAN II - SABUK HITAM" {{ old('tingkatan', $pengurus->tingkatan) == 'DAN II - SABUK HITAM' ? 'selected' : '' }}>DAN II - SABUK HITAM</option>
                            <option value="DAN III - SABUK HITAM" {{ old('tingkatan', $pengurus->tingkatan) == 'DAN III - SABUK HITAM' ? 'selected' : '' }}>DAN III - SABUK HITAM</option>
                            <option value="DAN IV - SABUK HITAM" {{ old('tingkatan', $pengurus->tingkatan) == 'DAN IV - SABUK HITAM' ? 'selected' : '' }}>DAN IV - SABUK HITAM</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-input" value="{{ old('nama_lengkap', $pengurus->nama_lengkap) }}" required>
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Periode</label>
                        <input type="text" name="periode" class="form-input" value="{{ old('periode', $pengurus->periode) }}" required>
                    </div>
                </div>

                <div style="margin-bottom: 15px;">
                    <label class="form-label">Prestasi Lomba</label>
                    <textarea name="prestasi_lomba" class="form-input" rows="3">{{ old('prestasi_lomba', $pengurus->prestasi_lomba) }}</textarea>
                </div>

                <div style="margin-bottom: 15px;">
                    <label class="form-label">Prestasi Sertifikasi</label>
                    <textarea name="prestasi_sertifikasi" class="form-input" rows="3">{{ old('prestasi_sertifikasi', $pengurus->prestasi_sertifikasi) }}</textarea>
                </div>

                <div style="margin-top: 25px;">
                    <button type="submit" class="btn bg-blue" style="width: 100%; padding: 12px; font-size: 16px;">Perbarui Data Pengurus</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
