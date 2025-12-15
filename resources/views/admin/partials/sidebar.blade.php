<div class="sidebar">
    <div class="nav-left">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <h1><b>RS Hewan<br>Pendidikan</b></h1>
        </div>
    </div>

    <ul class="nav-menu">
        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr>

        <li class="{{ request()->is('admin/roleuser') ? 'active' : '' }}">
            <a href="{{ route('admin.roleuser.index') }}">
                <i class="fa fa-users"></i>
                <span>Users</span>
            </a>
        </li>

        <hr>

        <li class="{{ request()->is('admin/jenishewan*') ? 'active' : '' }}">
            <a href="{{ route('admin.jenishewan.index') }}">
                <i class="fa fa-paw"></i>
                <span>Jenis Hewan</span>
            </a>
        </li>
        <li class="{{ request()->is('admin/rashewan*') ? 'active' : '' }}">
            <a href="{{ route('admin.rashewan.index') }}">
                <i class="fa fa-dog"></i>
                <span>Ras Hewan</span>
            </a>
        </li>

        <hr>

        <li class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">
            <a href="{{ route('admin.kategori.index') }}">
                <i class="fa fa-folder-open"></i>
                <span>Kategori</span>
            </a>
        </li>
        <li class="{{ request()->is('admin/kategoriklinis*') ? 'active' : '' }}">
            <a href="{{ route('admin.kategoriklinis.index') }}">
                <i class="fa fa-stethoscope"></i>
                <span>Kategori Klinis</span>
            </a>
        </li>
        <li class="{{ request()->is('admin/kodetindakan*') ? 'active' : '' }}">
            <a href="{{ route('admin.kodetindakan.index') }}">
                <i class="fa fa-syringe"></i>
                <span>Kode Tindakan</span>
            </a>
        </li>

        <hr>

        <li class="{{ request()->is('admin/pemilik*') ? 'active' : '' }}">
            <a href="{{ route('admin.pemilik.index') }}">
                <i class="fa fa-user-circle"></i>
                <span>Pemilik</span>
            </a>
        </li>
        <li class="{{ request()->is('admin/pet*') ? 'active' : '' }}">
            <a href="{{ route('admin.pet.index') }}">
                <i class="fa fa-cat"></i>
                <span>Pet</span>
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
