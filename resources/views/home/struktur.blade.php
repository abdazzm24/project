<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RS Hewan Pendidikan - Struktur Organisasi</title>
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;600;700&display=swap">
</head>
<body>
    <header class="navbar">
        <div class="nav-left">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
                <h1><b>RS Hewan<br>Pendidikan</b></h1>
            </div>
        </div>

        <div class="nav-center">
            <nav>
                <a href="/">Home</a>
                <a href="/struktur" class="active">Struktur</a>
                <a href="/informasi">Informasi</a>
            </nav>
        </div>
        
        <div class="nav-right">
            <a href="/login" class="btn-login">Login</a>
        </div>
    </header>

    <main class="container">
      <div class="content-box">
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
      </div>
    </main>

    <footer>
      <p>© 2025 RS Hewan Pendidikan Universitas Airlangga</p>
      <p>📍 Jl. Dharmawangsa No. 3, Surabaya | ☎️ (031) 1234567</p>
    </footer>
</body>
</html>
