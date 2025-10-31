<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Administrator</title>
</head>
<body>
  <h1>Selamat datang, Administrator {{ Auth::user()->name }}</h1>
  <a href="{{ route('logout') }}"
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
     Logout
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
      @csrf
  </form>
</body>
</html>
