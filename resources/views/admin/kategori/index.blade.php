@extends('admin.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">Kategori</h2>

    <div class="mb-3">
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>

    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $item => $k)
                    <tr>
                        <td>{{ $k->idkategori }}</td>
                        <td>{{ $k->nama_kategori }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning"
                                onclick="window.location='{{ route('admin.kategori.edit', $k->idkategori) }}'">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="openDeleteModal('{{ route('admin.kategori.destroy', $k->idkategori) }}')">
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
