<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <style>
        .form-container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 600px; margin-top: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .text-danger { color: red; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Admin Baru</h2>
        <a href="/admin/profile" class="link-back">&larr; Kembali ke Profil Admin</a>

        @if(session('error'))
            <div class="alert-error" style="font-weight: bold; margin-bottom: 20px; color: red;">✗ {{ session('error') }}</div>
        @endif

        <div class="form-container">
            <form action="/admin/profile" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-input" required value="{{ old('name') }}">
                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-input" required value="{{ old('username') }}">
                    @error('username')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="passwordInput" class="form-input" required style="padding-right: 40px;">
                        <i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #666;"></i>
                    </div>
                    @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Hak Akses (Role)</label>
                    <select name="role" class="form-input" required>
                        <option value="tier_1">TIER 1 (Admin - Akses Normal)</option>
                        <option value="tier_2">TIER 2 (Staff - Hanya Absensi & Profil Sendiri)</option>
                    </select>
                    @error('role')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn bg-green" style="width: 100%; padding: 12px; margin-top: 10px;">Simpan Admin</button>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#passwordInput');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
