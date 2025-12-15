@extends('admin.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">Data Pemilik</h2>

    <div class="mb-3">
        <a href="{{ route('admin.pemilik.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pemilik
        </a>
    </div>

    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>No WhatsApp</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemilik as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                        <td>{{ $item->no_wa ?? '-' }}</td>
                        <td>{{ $item->alamat ?? '-' }}</td>
                        <td>{{ $item->user->email ?? '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" 
                                onclick="window.location='{{ route('admin.pemilik.edit', $item->idpemilik) }}'">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <button class="btn btn-sm btn-danger"
                                onclick="openDeleteModal('{{ route('admin.pemilik.destroy', $item->idpemilik) }}')">
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
