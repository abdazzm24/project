<div class="sidebar">
    <div class="nav-left">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <h1><b>RS Hewan<br>Pendidikan</b></h1>
        </div>
    </div>

    <ul class="nav-menu">
        <li class="{{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
            <a href="{{ route('perawat.dashboard') }}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr>

        <!-- INPUT REKAM MEDIS (CREATE) -->
        <li class="{{ request()->routeIs('perawat.rekammedis.create') ? 'active' : '' }}">
            <a href="{{ route('perawat.rekammedis.create') }}">
                <i class="fa fa-plus-circle"></i>
                <span>Input Rekam Medis</span>
            </a>
        </li>

        <hr>

        <!-- DAFTAR REKAM MEDIS (INDEX) -->
        <li class="{{ request()->routeIs('perawat.rekammedis.index') || request()->routeIs('perawat.rekammedis.show') ? 'active' : '' }}">
            <a href="{{ route('perawat.rekammedis.index') }}">
                <i class="fa fa-notes-medical"></i>
                <span>Daftar Rekam Medis</span>
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
