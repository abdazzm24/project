<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RS Hewan Pendidikan - Lainnya</title>
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
                <a href="/struktur">Struktur</a>
                <a href="/informasi" class="active">Informasi</a>
            </nav>
        </div>
        
        <div class="nav-right">
            <a href="/login" class="btn-login">Login</a>
        </div>
    </header>

    <main class="container">
      <div class="content-box">
        <section id="visimisi" data-aos="fade-up">
          <h2>Visi Misi dan Tujuan</h2>
          <ul>
            <li><b>Visi :</b> Menjadi rumah sakit hewan terkemuka dalam pendidikan dan pelayanan kesehatan.</li>
            <li><b>Misi :</b> Memberikan perawatan terbaik dan mendidik masyarakat tentang kesehatan hewan.</li>
            <li><b>Tujuan :</b> Meningkatkan kesadaran kesehatan hewan dan menyediakan pelatihan praktis bagi mahasiswa.</li>
          </ul>    
        </section>
      </div>

      <div class="content-box">
        <section id="layanan" data-aos="fade-up">
          <h2>Layanan Umum</h2>
          <ul>
            <li><i class="fa-solid fa-stethoscope"></i> Pemeriksaan Rutin</li>
            <li><i class="fa-solid fa-syringe"></i> Vaksinasi</li>
            <li><i class="fa-solid fa-ambulance"></i> Perawatan Darurat 24 Jam</li>
            <li><i class="fa-solid fa-scissors"></i> Grooming</li>
          </ul>
        </section>
      </div>

      <div class="content-box">
        <section id="galeri" data-aos="fade-up">
          <h2>Galeri Kegiatan</h2>
          <div class="galeri-container">
            <img src="{{ asset('img/hewan1.jpg') }}" alt="Perawatan Hewan">
            <img src="{{ asset('img/hewan2.jpg') }}" alt="Vaksinasi">
            <img src="{{ asset('img/hewan3.jpg') }}" alt="Kegiatan Mahasiswa">
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
