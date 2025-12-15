@extends('admin.layouts.crud')
@section('title', 'Edit Kategori')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Edit Kategori</h2>

        <form action="{{ route('admin.kategori.update', $kategori->idkategori) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kategori <span>*</span></label>
                <input type="text" name="nama_kategori"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       class="@error('nama_kategori') is-invalid @enderror">

                @error('nama_kategori')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.kategori.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Update</button>
            </div>

        </form>

    </div>
</div>
@endsection
