<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/beranda/popup.css') }}">
</head>
<body style="text-align: center; margin-top: 100px; font-family: sans-serif;">

    <h1>Selamat Datang di DOJO AL-HANIF</h1>
    
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; width: 300px; margin: 0 auto 20px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- JIKA SUDAH LOGIN -->
    @auth
        <div style="margin-top: 30px; padding: 20px; background: #f0f2f5; display: inline-block; border-radius: 8px;">
            <p style="margin-bottom: 15px;">Halo, <strong>{{ Auth::user()->name }}</strong>!</p>
            <a href="/dashboard" style="background: #2980b9; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
                Masuk ke Dashboard Admin
            </a>
            <br><br>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" style="background: transparent; border: none; color: red; cursor: pointer; text-decoration: underline;">Keluar Akun</button>
            </form>
        </div>
    <!-- JIKA BELUM LOGIN -->
    @else
        <p>Gunakan kode rahasia untuk masuk ke ruang admin.</p>
        <br>
        <a href="/daftar" style="color: red; font-weight: bold; text-decoration: none;">Halaman Pendaftaran Publik</a>
    @endauth

    <!-- MODAL LOGIN RAHASIA -->
    <div id="loginModal" class="modal-overlay">
        <div class="modal-box">
            <span class="close-btn" onclick="tutupModal()" style="float: right; cursor: pointer;">&times;</span>
            <h2>Masuk Ruang Admin</h2>
            @if(session('error'))
                <p style="color: red; font-size: 13px;">{{ session('error') }}</p>
            @endif
            <form action="/pintu-rahasia" method="POST">
                @csrf
                <div class="form-group"><label>Username</label><input type="text" name="username" class="form-control" required autocomplete="off"></div>
                <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                <button type="submit" class="btn-submit" style="width: 100%; background: red; color: white; padding: 10px;">Masuk</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/beranda/popup.js') }}"></script>
    <script>
        // Buka otomatis kalau salah password
        window.onload = function() {
            if ("{{ session('error') }}") {
                document.getElementById("loginModal").style.display = "flex";
            }
        };
    </script>
</body>
</html>