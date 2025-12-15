<div class="sidebar">
    <div class="nav-left">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <h1><b>RS Hewan<br>Pendidikan</b></h1>
        </div>
    </div>

    <ul class="nav-menu">
        <li class="{{ request()->is('pemilik/dashboard') ? 'active' : '' }}">
            <a href="{{ route('pemilik.dashboard') }}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr>

    </ul>

    <div class="logout-section">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <i class="fa fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>
