<div class="sidebar">
    <div class="nav-left">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <h1><b>RS Hewan<br>Pendidikan</b></h1>
        </div>
    </div>

    <ul class="nav-menu">
        <li class="{{ request()->is('dokter/dashboard') ? 'active' : '' }}">
            <a href="{{ route('dokter.dashboard') }}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr>

        <li class="{{ request()->is('dokter/inputrekam') ? 'active' : '' }}">
            <a href="{{ route('dokter.rekammedis.create') }}">
                <i class="fa fa-notes-medical"></i>
                <span>Input Rekam Medis</span>
            </a>
        </li>

        <hr>
        
        <li class="{{ request()->is('dokter/rekammedis') ? 'active' : '' }}">
            <a href="{{ route('dokter.rekammedis.index') }}">
                <i class="fa fa-notes-medical"></i>
                <span>Rekam Medis</span>
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
