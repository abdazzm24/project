@extends('admin.layouts.crud')
@section('title', 'Tambah Jenis Hewan')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Tambah Jenis Hewan</h2>

        <form action="{{ route('admin.jenishewan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Jenis Hewan <span>*</span></label>
                <input type="text" 
                       name="nama_jenis_hewan"
                       value="{{ old('nama_jenis_hewan') }}"
                       class="@error('nama_jenis_hewan') is-invalid @enderror"
                       placeholder="Contoh: Kucing, Anjing, Kelinci">

                @error('nama_jenis_hewan')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.jenishewan.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>
@endsection