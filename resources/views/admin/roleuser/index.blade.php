@extends('admin.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">User Management</h2>

    <div class="mb-3">
        <a href="{{ route('admin.roleuser.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Role User
        </a>
    </div>

    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roleuser as $index => $ru)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ru->user->nama }}</td>
                        <td>{{ $ru->user->email }}</td>
                        <td>{{ $ru->role->nama_role }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ route('admin.roleuser.edit', $ru->idrole_user) }}'">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn-danger"
                                onclick="openDeleteModal('{{ route('admin.roleuser.destroy', $ru->idrole_user) }}')">
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
