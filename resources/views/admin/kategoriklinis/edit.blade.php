@extends('admin.layouts.crud')
@section('title', 'Edit Kategori Klinis')

@section('content')
<div class="form-page">
    <div class="form-card">
        
        <h2 class="form-title">Edit Kategori Klinis</h2>

        <form action="{{ route('admin.kategoriklinis.update', $kategoriKlinis->idkategori_klinis) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kategori Klinis <span>*</span></label>
                <input type="text" name="nama_kategori_klinis"
                       value="{{ old('nama_kategori_klinis', $kategoriKlinis->nama_kategori_klinis) }}"
                       class="@error('nama_kategori_klinis') is-invalid @enderror">

                @error('nama_kategori_klinis')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.kategoriklinis.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Update</button>
            </div>

        </form>

    </div>
</div>
@endsection
