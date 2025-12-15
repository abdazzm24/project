@extends('admin.layouts.crud')
@section('title', 'Tambah Ras Hewan')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Tambah Ras Hewan</h2>

        <form action="{{ route('admin.rashewan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Ras Hewan <span>*</span></label>
                <input type="text" name="nama_ras"
                       value="{{ old('nama_ras') }}"
                       class="@error('nama_ras') is-invalid @enderror">

                @error('nama_ras')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Jenis Hewan <span>*</span></label>
                <select name="idjenis_hewan" class="@error('idjenis_hewan') is-invalid @enderror">
                    <option value="">-- Pilih Jenis Hewan --</option>

                    @foreach($jenis as $j)
                        <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>
                    @endforeach
                </select>

                @error('idjenis_hewan')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.rashewan.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>
@endsection
