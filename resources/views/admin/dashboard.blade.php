<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - DOJO AL-HANIF</title>

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>

<body style="background-color: #f0f2f5;">

  <div class="admin-container">
    <div class="header-admin">
      <div>
        <h1>Dashboard Admin</h1>
        <p>Halo, <strong>{{ Auth::user()->name }}</strong>
          <span class="user-tier">({{ strtoupper(str_replace('_', ' ', Auth::user()->role)) }})</span>
        </p>
      </div>
      <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn-logout">Keluar Sistem</button>
      </form>
    </div>

    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div style="margin-bottom: 30px; display: flex; gap: 10px;">
      <a href="#tabel-calon" class="btn-wa" style="background: #f39c12; padding: 10px 20px;">Pendaftar Baru
        ({{ $calon->count() }})</a>
      <a href="#tabel-aktif" class="btn-wa" style="background: #2980b9; padding: 10px 20px;">Anggota Resmi
        ({{ $aktif->count() }})</a>
    </div>

    <div id="tabel-calon" class="table-section">
      <h3 style="color: #d35400; margin-bottom: 15px;">🟠 Calon Anggota Baru</h3>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Nama</th>
              <th>WhatsApp</th>
              <th>Umur</th>
              <th>Sabuk</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($calon as $c)
              <tr>
                <td><strong>{{ $c->nama_lengkap }}</strong></td>
                <td>{{ $c->no_whatsapp }}</td>
                <td>{{ $c->umur }} Thn</td>
                <td>{{ $c->sabuk ?? 'Pemula' }}</td>
                <td>
                  <div class="action-group">
                    <a href="https://wa.me/{{ $c->no_whatsapp }}" target="_blank" class="btn-wa">WA</a>

                    <form action="/admin/member/{{ $c->id }}/terima" method="POST"
                      onsubmit="return confirm('Terima anggota ini?')">
                      @csrf
                      <button type="submit" class="btn-terima">Terima</button>
                    </form>

                    <form action="/admin/member/{{ $c->id }}/hapus" method="POST"
                      onsubmit="return confirm('Hapus data pendaftaran ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-hapus">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">Tidak ada calon anggota baru.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <hr style="margin: 50px 0; border: 1px solid #ddd;">

    <div id="tabel-aktif" class="table-section">
      <h3 style="color: #27ae60; margin-bottom: 15px;">🟢 Anggota Resmi Dojo</h3>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Sabuk</th>
              <th>WhatsApp</th>
              <th>Tgl Diterima</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($aktif as $a)
              <tr>
                <td><strong>{{ $a->nama_lengkap }}</strong></td>
                <td><span class="badge badge-aktif">{{ $a->sabuk ?? 'Putih' }}</span></td>
                <td>{{ $a->no_whatsapp }}</td>
                <td>{{ $a->tanggal_diterima->format('d M Y') }}</td>
                <td>
                  <div class="action-group">
                    <a href="https://wa.me/{{ $a->no_whatsapp }}" target="_blank" class="btn-wa">Chat</a>

                    <form action="/admin/member/{{ $a->id }}/hapus" method="POST"
                      onsubmit="return confirm('Hapus dari anggota resmi?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-hapus">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">Belum ada anggota resmi terdaftar.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>

</html>