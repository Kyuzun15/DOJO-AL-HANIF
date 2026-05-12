<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/pendaftaran/sukses.css') }}">
</head>
<body>
    <div class="success-card">
        <div class="icon">✅</div>
        <h2>Pendaftaran Tersimpan!</h2>
        <p>Data Anda telah masuk ke dalam sistem. <strong>Langkah terakhir:</strong> Kirimkan notifikasi data Anda ke WhatsApp Admin agar segera diproses.</p>
        
        @if(session('wa_link'))
            <!-- Tombol Manual (Penyelamat jika Pop-up diblokir) -->
            <a href="{{ session('wa_link') }}" target="_blank" class="btn-wa-large">
                Kirim Data ke WhatsApp Admin
            </a>
            
            <script src="{{ asset('js/pendaftaran/sukses.js') }}"></script>
            <script>
                triggerWaLink("{!! session('wa_link') !!}");
            </script>
        @else
            <!-- Jika tidak ada sesi WA (misal user refresh halaman) -->
            <p style="color: #e74c3c;"><em>Sesi WhatsApp telah berakhir. Admin akan tetap mengecek data Anda di sistem.</em></p>
        @endif

        <a href="/" class="btn-home">Kembali ke Beranda</a>
    </div>
</body>
</html>