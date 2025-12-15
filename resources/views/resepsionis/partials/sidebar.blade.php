<div class="sidebar">
    <div class="nav-left">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <h1><b>RS Hewan<br>Pendidikan</b></h1>
        </div>
    </div>

    <ul class="nav-menu">
        <li class="{{ request()->is('resepsionis/dashboard') ? 'active' : '' }}">
            <a href="{{ route('resepsionis.dashboard') }}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr>

        <li class="{{ request()->is('resepsionis/regispemilik*') ? 'active' : '' }}">
            <a href="{{ route('resepsionis.regispemilik.index') }}">
                <i class="fa fa-user-circle"></i>
                <span>Regis Pemilik</span>
            </a>
        </li>

        <hr>

        <li class="{{ request()->is('resepsionis/regispet*') ? 'active' : '' }}">
            <a href="{{ route('resepsionis.regispet.index') }}">
                <i class="fa fa-cat"></i>
                <span>Regis Pet</span>
            </a>
        </li>

        <hr>

        <li class="{{ request()->is('resepsionis/temudokter*') ? 'active' : '' }}">
            <a href="{{ route('resepsionis.temudokter.index') }}">
                <i class="fa fa-stethoscope"></i>
                <span>Temu Dokter</span>
            </a>
        </li>
        
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
