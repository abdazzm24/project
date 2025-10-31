<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RS Hewan Pendidikan - Home</title>
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
                <a href="/" class="active">Home</a>
                <a href="/struktur">Struktur</a>
                <a href="/informasi">Informasi</a>
            </nav>
        </div>
        
        <div class="nav-right">
            <a href="/login" class="btn-login">Login</a>
        </div>
    </header>

    <section class="hero">
        <div class="hero-text">
            <h2>Selamat Datang di Rumah Sakit Hewan Pendidikan</h2>
            <p>Kami menyediakan layanan medis terbaik untuk hewan peliharaan dan berfungsi sebagai pusat pendidikan bagi mahasiswa kedokteran hewan.</p>
        </div>
        <div class="hero-image">
            <img src="{{ asset('img/home.jpg') }}" alt="Hewan" />
        </div>
    </section>

    <footer>
        <p>© 2025 RS Hewan Pendidikan Universitas Airlangga</p>
        <p>📍 Jl. Dharmawangsa No. 3, Surabaya | ☎️ (031) 1234567</p>
    </footer>
</body>
</html>
