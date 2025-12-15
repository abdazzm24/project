@extends('resepsionis.layouts.crud')
@section('title', 'Regis Pemilik')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Registrasi Pemilik</h2>

        <form action="{{ route('resepsionis.regispemilik.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="form-group">
                <label>Nama <span>*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="@error('nama') is-invalid @enderror">
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email <span>*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label>Password <span>*</span></label>
                <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Ulangi Password -->
            <div class="form-group">
                <label>Ulangi Password <span>*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- No WhatsApp -->
            <div class="form-group">
                <label>No WhatsApp <span>*</span></label>
                <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa') }}" class="@error('no_wa') is-invalid @enderror">
                @error('no_wa')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="form-group">
                <label>Alamat <span>*</span></label>
                <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" class="@error('alamat') is-invalid @enderror">
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('resepsionis.regispemilik.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>
@endsection