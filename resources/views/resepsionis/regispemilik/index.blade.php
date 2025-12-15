@extends('resepsionis.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">Registrasi Pemilik</h2>

    <div class="mb-3">
        <a href="{{ route('resepsionis.regispemilik.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Regis Pemilik
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
