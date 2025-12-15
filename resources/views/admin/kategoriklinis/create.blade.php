@extends('admin.layouts.crud')
@section('title', 'Tambah Kategori Klinis')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Tambah Kategori Klinis</h2>

        <form action="{{ route('admin.kategoriklinis.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Kategori Klinis <span>*</span></label>
                <input type="text" name="nama_kategori_klinis"
                       value="{{ old('nama_kategori_klinis') }}"
                       class="@error('nama_kategori_klinis') is-invalid @enderror">

                @error('nama_kategori_klinis')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.kategoriklinis.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>
@endsection
