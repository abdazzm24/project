<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Register</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>
<body>
  <div class="login-container">
      <img src="{{ asset('img/bg.jpg') }}" alt="Background" class="bg-image">

      <div class="text-overlay">
          <h1>Project PBD</h1>
          <p>Bergabung dan nikmati kemudahan dalam mengelola data penjualan Anda.</p>
      </div>  

      <div class="login-box">
          <h2>Daftar Akun Baru</h2>
          <p>Silakan isi data di bawah ini untuk mendaftar.</p>

          <form method="POST" action="{{ route('register') }}">
              @csrf
              <input type="text" name="nama" placeholder="Nama Lengkap" required>

              <input type="email" name="email" placeholder="Email" required>

              <input type="password" name="password" placeholder="Password" required>

              <input type="password" name="password_confirmation" placeholder="Ulangi Password" required>

              <input type="submit" value="Daftar">

              @if ($errors->any())
                  <div class="error">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
          </form>

          <p class="register-text">
              Sudah punya akun?
              <a href="{{ route('login') }}">Masuk di sini</a>
          </p>
          <p class="back-home">
              <a href="{{ url('/') }}">Kembali ke Beranda</a>
          </p>

      </div>
  </div>
</body>
</html>
