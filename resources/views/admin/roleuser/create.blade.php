@extends('admin.layouts.crud')
@section('title', 'Tambah User & Role')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Tambah User & Role</h2>

        <form action="{{ route('admin.roleuser.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama <span>*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                       class="@error('nama') is-invalid @enderror"
                       placeholder="Masukkan nama user">
                @error('nama')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Email <span>*</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="@error('email') is-invalid @enderror"
                       placeholder="Masukkan email user">
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Pilih Role <span>*</span></label>
                <select name="idrole" class="@error('idrole') is-invalid @enderror">
                    <option value="">-- Pilih Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                    @endforeach
                </select>
                @error('idrole')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Password <span>*</span></label>
                <input type="password" name="password"
                       class="@error('password') is-invalid @enderror"
                       placeholder="Masukkan password">
                @error('password')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Ulangi Password <span>*</span></label>
                <input type="password" name="password_confirmation"
                       placeholder="Ketik ulang password">
            </div>


            <div class="form-buttons">
                <a href="{{ route('admin.roleuser.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>
@endsection
