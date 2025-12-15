@extends('admin.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">Data Pet</h2>

    <div class="mb-3">
        <a href="{{ route('admin.pet.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pet
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
                    <th>Aksi</th>
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
                        <td>
                            <button class="btn btn-sm btn-warning" 
                                onclick="window.location='{{ route('admin.pet.edit', $p->idpet) }}'">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <button class="btn btn-sm btn-danger"
                                onclick="openDeleteModal('{{ route('admin.pet.destroy', $p->idpet) }}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.partials.delete')

@endsection
