@extends('admin.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">Jenis Hewan</h2>

    <div class="mb-3">
        <a href="{{ route('admin.jenishewan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jenis Hewan
        </a>
    </div>

    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jenis Hewan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisHewan as $index => $hewan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $hewan->nama_jenis_hewan }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ route('admin.jenishewan.edit', $hewan->idjenis_hewan) }}'">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" 
                                    onclick="openDeleteModal('{{ route('admin.jenishewan.destroy', $hewan->idjenis_hewan) }}')">
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
