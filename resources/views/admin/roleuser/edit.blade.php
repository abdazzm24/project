@extends('admin.layouts.crud')
@section('title', 'Edit Role User')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Edit Role User</h2>

        <form action="{{ route('admin.roleuser.update', $roleuser->idrole_user) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- NAMA -->
            <div class="form-group">
                <label>Nama <span>*</span></label>
                <input type="text" name="nama"
                       value="{{ old('nama', $roleuser->user->nama) }}"
                       class="@error('nama') is-invalid @enderror">
                @error('nama')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="form-group">
                <label>Email <span>*</span></label>
                <input type="email" name="email"
                       value="{{ old('email', $roleuser->user->email) }}"
                       class="@error('email') is-invalid @enderror">
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <!-- ROLE (DIPINDAH KE SINI) -->
            <div class="form-group">
                <label>Pilih Role <span>*</span></label>
                <select name="idrole" class="@error('idrole') is-invalid @enderror">
                    @foreach ($roles as $role)
                        <option value="{{ $role->idrole }}"
                            {{ $role->idrole == $roleuser->idrole ? 'selected' : '' }}>
                            {{ $role->nama_role }}
                        </option>
                    @endforeach
                </select>
                @error('idrole')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD (opsional) -->
            <div class="form-group">
                <label>Password (biarkan kosong jika tidak diubah)</label>
                <input type="password" name="password"
                       class="@error('password') is-invalid @enderror">
                @error('password')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <!-- RETYPE (opsional) -->
            <div class="form-group">
                <label>Ulangi Password</label>
                <input type="password" name="password_confirmation"
                       class="@error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.roleuser.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Update</button>
            </div>

        </form>

    </div>
</div>
@endsection
