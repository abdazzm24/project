@extends('admin.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">Kode Tindakan Terapi</h2>

    <div class="mb-3">
        <a href="{{ route('admin.kodetindakan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kode Tindakan Terapi
        </a>
    </div>

    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Deskripsi Tindakan Terapi</th>
                    <th>Nama Kategori</th>
                    <th>Nama Kategori Klinis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kodeTindakan as $item)
                    <tr>
                        <td>{{ $item->idkode_tindakan_terapi }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ $item->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" 
                                onclick="window.location='{{ route('admin.kodetindakan.edit', $item->idkode_tindakan_terapi) }}'">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <button class="btn btn-sm btn-danger"
                                onclick="openDeleteModal('{{ route('admin.kodetindakan.destroy', $item->idkode_tindakan_terapi) }}')">
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
