<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - RS Hewan Pendidikan</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;600;700&display=swap">
</head>
<body>
  <div class="logo">
      <img src="{{ asset('img/logo.png') }}" alt="Logo">
      <h1><b>RS Hewan<br>Pendidikan</b></h1>
  </div>
  
  <div class="login-box">
    <h3>Selamat Datang</h3>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">

      @if (session('flash_msg'))
        <p class="error">{{ session('flash_msg') }}</p>
      @endif
    </form>

    <a href="/" class="back-home">Kembali</a>
  </div>
</body>
</html>
