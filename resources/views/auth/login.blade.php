<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>
<body>
  <div class="login-container">
      <img src="{{ asset('img/bg.jpg') }}" alt="Background" class="bg-image">

      <div class="text-overlay">
          <h1>Project PBD</h1>
          <p>Sistem penjualan modern yang membantu Anda mengelola produk, transaksi, dan stok dengan efisien.</p>
      </div>  

      <div class="login-box">
          <h2>Selamat Datang</h2>
          <p>Masuk untuk melanjutkan ke dashboard Anda.</p>

          <form method="POST" action="{{ route('login') }}">
              @csrf
              <label>Email</label>
              <input type="email" name="email" placeholder="Email" required>
              
              <label>Password</label>
              <input type="password" name="password" placeholder="Password" required>
              
              <input type="submit" value="Login">

              @if (session('flash_msg'))
                  <p class="error">{{ session('flash_msg') }}</p>
              @endif
          </form>

          <p class="register-text">
              Belum punya akun?
              <a style="pointer-events: none;">Daftar sekarang</a>
          </p>
          <p class="back-home">
              <a href="{{ url('/') }}">Kembali ke Beranda</a>
          </p>

      </div>
  </div>
</body>
</html>
