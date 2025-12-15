@extends('admin.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">Kategori Klinis</h2>

    <div class="mb-3">
        <a href="{{ route('admin.kategoriklinis.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori Klinis
        </a>
    </div>

    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori Klinis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoriKlinis as $item)
                    <tr>
                        <td>{{ $item->idkategori_klinis }}</td>
                        <td>{{ $item->nama_kategori_klinis }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning"
                                onclick="window.location='{{ route('admin.kategoriklinis.edit', $item->idkategori_klinis) }}'">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="openDeleteModal('{{ route('admin.kategoriklinis.destroy', $item->idkategori_klinis) }}')">
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
