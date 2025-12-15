@extends('admin.layouts.crud')
@section('title', 'Tambah Kategori')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Tambah Kategori</h2>

        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Kategori <span>*</span></label>
                <input type="text" name="nama_kategori"
                       value="{{ old('nama_kategori') }}"
                       class="@error('nama_kategori') is-invalid @enderror">

                @error('nama_kategori')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.kategori.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>
@endsection
