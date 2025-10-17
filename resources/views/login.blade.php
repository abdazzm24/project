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
  <div class="login-box">
    <h3>Selamat Datang</h3>
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
