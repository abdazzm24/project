@extends('admin.layouts.crud')
@section('title', 'Tambah Kode Tindakan Terapi')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Tambah Kode Tindakan</h2>

        <form action="{{ route('admin.kodetindakan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Kode <span>*</span></label>
                <input type="text" name="kode"
                       placeholder="Contoh: T01 atau A02"
                       value="{{ old('kode') }}"
                       class="@error('kode') is-invalid @enderror">
                @error('kode')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Deskripsi Tindakan Terapi <span>*</span></label>
                <input type="text" name="deskripsi_tindakan_terapi"
                       value="{{ old('deskripsi_tindakan_terapi') }}"
                       class="@error('deskripsi_tindakan_terapi') is-invalid @enderror">

                @error('deskripsi_tindakan_terapi')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Kategori <span>*</span></label>
                <select name="idkategori" class="@error('idkategori') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>

                @error('idkategori')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Kategori Klinis <span>*</span></label>
                <select name="idkategori_klinis" class="@error('idkategori_klinis') is-invalid @enderror">
                    <option value="">-- Pilih Kategori Klinis --</option>
                    @foreach($kategoriKlinis as $kk)
                        <option value="{{ $kk->idkategori_klinis }}">{{ $kk->nama_kategori_klinis }}</option>
                    @endforeach
                </select>

                @error('idkategori_klinis')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.kodetindakan.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>
@endsection
