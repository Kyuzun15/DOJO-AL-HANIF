<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - DOJO AL-HANIF</title>
    <style>
        body { 
            background-color: #f0f2f5; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .success-card { 
            background: white; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
            text-align: center; 
            max-width: 500px; 
        }
        .icon { 
            font-size: 60px; 
            color: #27ae60; 
            margin-bottom: 15px; 
        }
        h2 { 
            color: #2c3e50; 
            margin-bottom: 15px; 
            margin-top: 0;
        }
        p { 
            color: #7f8c8d; 
            line-height: 1.6; 
            margin-bottom: 30px; 
            font-size: 15px;
        }
        
        /* Tombol WA Manual */
        .btn-wa-large { 
            background: #25d366; 
            color: white; 
            padding: 15px 30px; 
            text-decoration: none; 
            border-radius: 8px; 
            font-weight: bold; 
            display: inline-block;
            margin-bottom: 15px;
            font-size: 16px;
            box-shadow: 0 4px 10px rgba(37, 211, 102, 0.3);
            transition: 0.3s;
        }
        .btn-wa-large:hover { background: #128c7e; transform: translateY(-2px); }
        
        .btn-home { 
            color: #3498db; 
            text-decoration: none; 
            font-weight: bold; 
            display: block;
            margin-top: 20px;
        }
        .btn-home:hover { text-decoration: underline; }
    </style>
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
            
            <script>
                // Mencoba buka otomatis dengan sedikit jeda (kadang bisa mengelabui blocker)
                setTimeout(function() {
                    window.open("{!! session('wa_link') !!}", "_blank");
                }, 1500);
            </script>
        @else
            <!-- Jika tidak ada sesi WA (misal user refresh halaman) -->
            <p style="color: #e74c3c;"><em>Sesi WhatsApp telah berakhir. Admin akan tetap mengecek data Anda di sistem.</em></p>
        @endif

        <a href="/" class="btn-home">Kembali ke Beranda</a>
    </div>
</body>
</html>