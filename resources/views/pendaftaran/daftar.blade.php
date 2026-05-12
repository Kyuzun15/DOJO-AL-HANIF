<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran - DOJO AL-HANIF</title>
    <!-- Memanggil file CSS -->
    <link rel="stylesheet" href="{{ asset('css/pendaftaran/daftar.css') }}">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>

    <div class="form-container">
        <h2>Formulir Pendaftaran</h2>
        <p class="subtitle">Lengkapi data diri calon anggota di bawah ini</p>

        <!-- Pesan Error Validasi -->
        @if ($errors->any())
            <div class="alert-danger">
                Terdapat kesalahan pengisian:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/daftar" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <!-- value="{{ old('nama') }}" berfungsi agar jika terjadi error, ketikan user tidak hilang -->
                <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Budi Santoso">
            </div>

            <!-- Menggunakan form-row agar bersebelahan -->
            <div class="form-row">
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                        placeholder="Contoh: Jakarta">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir (DD/MM/YYYY)</label>
                    <input type="text" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                        placeholder="Contoh: 17/08/2005">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Berat Badan (Kg)</label>
                    <input type="number" name="berat_badan" value="{{ old('berat_badan') }}" required
                        placeholder="Contoh: 45">
                </div>
                <div class="form-group">
                    <label>Tinggi Badan (Cm)</label>
                    <input type="number" name="tinggi_badan" value="{{ old('tinggi_badan') }}" required
                        placeholder="Contoh: 150">
                </div>
            </div>

            <!-- Fieldset untuk mengelompokkan data orang tua -->
            <fieldset>
                <legend>Data Orang Tua</legend>
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Ayah</label>
                        <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" required>
                    </div>
                    <div class="form-group">
                        <label>No. HP Ayah <small>(Isi salah satu jika tidak ada)</small></label>
                        <input type="tel" name="no_hp_ayah" value="{{ old('no_hp_ayah', '+62') }}" 
                            placeholder="+628..." 
                            oninput="if(!this.value.startsWith('+62')) this.value = '+62' + this.value.replace(/[^0-9]/g, ''); else this.value = '+62' + this.value.substring(3).replace(/[^0-9]/g, '');">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" required>
                    </div>
                    <div class="form-group">
                        <label>No. HP Ibu <small>(Isi salah satu jika tidak ada)</small></label>
                        <input type="tel" name="no_hp_ibu" value="{{ old('no_hp_ibu', '+62') }}" 
                            placeholder="+628..." 
                            oninput="if(!this.value.startsWith('+62')) this.value = '+62' + this.value.replace(/[^0-9]/g, ''); else this.value = '+62' + this.value.substring(3).replace(/[^0-9]/g, '');">
                    </div>
                </div>
            </fieldset>

            <div class="form-group">
                <label>Alamat Rumah Lengkap</label>
                <textarea name="alamat" rows="3" required
                    placeholder="Jalan, RT/RW, Kelurahan, Kecamatan...">{{ old('alamat') }}</textarea>
            </div>

            <div class="form-group">
                <label>Ukuran Baju Karate</label>
                <input type="text" name="ukuran_baju" value="{{ old('ukuran_baju') }}" required
                    placeholder="Contoh: S, M, L, XL">
            </div>

            <!-- Kolom Sabuk sudah Dihilangkan -->

            <button type="submit" class="btn-submit">Kirim Pendaftaran</button>
            <a href="/" class="btn-back">Batal dan Kembali</a>
        </form>
    </div>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script src="{{ asset('js/pendaftaran/daftar.js') }}"></script>
</body>

</html>