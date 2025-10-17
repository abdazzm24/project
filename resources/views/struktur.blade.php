<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RS Hewan Pendidikan - Struktur Organisasi</title>
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <header class="navbar">
    <div class="logo">
      <img src="{{ asset('img/unair.png') }}" alt="Logo UNAIR">
      <h1><b>RS Hewan Pendidikan</b></h1>
    </div>
    <nav>
        <a href="/">Home</a>
        <a href="/struktur" class="active">Struktur</a>
        <a href="/informasi">Informasi</a>
        <a href="/login">Login</a>
    </nav>
  </header>

  <main class="container">
    <section id="struktur" data-aos="fade-up">
      <h2>Struktur Organisasi</h2>
      <div class="struktur-container">
        <div class="struktur-card">
          <img src="{{ asset('img/direktur.jpeg') }}" alt="Direktur">
          <h3>Drh. Budi Speed</h3>
          <p>Direktur Utama</p>
        </div>
        <div class="struktur-card">
          <img src="{{ asset('img/spesialis.jpeg') }}" alt="Spesialis">
          <h3>Drh. Diaul Haq</h3>
          <p>Dokter Hewan Spesialis</p>
        </div>
        <div class="struktur-card">
          <img src="{{ asset('img/admin.jpeg') }}" alt="Admin">
          <h3>Robithoh Ahmad</h3>
          <p>Tim Administrasi</p>
        </div>
      </div>
    </section>
    <br>
    <section id="struktur" data-aos="fade-up">
      <div class="struktur-container">
        <div class="struktur-card">
          <img src="{{ asset('img/direktur.jpeg') }}" alt="Direktur">
          <h3>Drh. Budi Speed</h3>
          <p>Direktur Utama</p>
        </div>
        <div class="struktur-card">
          <img src="{{ asset('img/spesialis.jpeg') }}" alt="Spesialis">
          <h3>Drh. Diaul Haq</h3>
          <p>Dokter Hewan Spesialis</p>
        </div>
        <div class="struktur-card">
          <img src="{{ asset('img/admin.jpeg') }}" alt="Admin">
          <h3>Robithoh Ahmad</h3>
          <p>Tim Administrasi</p>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <p>© 2025 RS Hewan Pendidikan Universitas Airlangga</p>
    <p>📍 Jl. Dharmawangsa No. 3, Surabaya | ☎️ (031) 1234567</p>
  </footer>
</body>
</html>
