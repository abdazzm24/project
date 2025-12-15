@extends('admin.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">Ras Hewan</h2>

    <div class="mb-3">
        <a href="{{ route('admin.rashewan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Ras Hewan
        </a>
    </div>

    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ras Hewan</th>
                    <th>Jenis Hewan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rasHewan as $index => $r)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $r->nama_ras }}</td>
                        <td>{{ $r->jenisHewan->nama_jenis_hewan }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ route('admin.rashewan.edit', $r->idras_hewan) }}'">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" 
                                    onclick="openDeleteModal('{{ route('admin.rashewan.destroy', $r->idras_hewan) }}')">
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