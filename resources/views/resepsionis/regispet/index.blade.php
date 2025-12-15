@extends('resepsionis.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">Registrasi Pet</h2>

    <div class="mb-3">
        <a href="{{ route('resepsionis.regispet.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Regis Pet
        </a>
    </div>

    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Warna Tanda</th>
                    <th>Jenis Kelamin</th>
                    <th>Pemilik</th>
                    <th>Ras Hewan</th>
                    <th>Jenis Hewan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pet as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->tanggal_lahir ? $p->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                        <td>{{ $p->warna_tanda }}</td>
                        <td>{{ $p->jenis_kelamin }}</td>
                        <td>{{ $p->pemilik->user->nama ?? '-' }}</td>
                        <td>{{ $p->rasHewan->nama_ras ?? '-' }}</td>
                        <td>{{ $p->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
