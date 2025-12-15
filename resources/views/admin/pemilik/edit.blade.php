@extends('admin.layouts.crud')
@section('title', 'Edit Pemilik')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Edit Pemilik</h2>

        <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama <span>*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $pemilik->user->nama) }}">
            </div>

            <div class="form-group">
                <label>Email <span>*</span></label>
                <input type="email" name="email" value="{{ old('email', $pemilik->user->email) }}">
            </div>

            <div class="form-group">
                <label>Password (kosongkan jika tidak diganti)</label>
                <input type="password" name="password">
            </div>

            <div class="form-group">
                <label>Ulangi Password</label>
                <input type="password" name="password_confirmation">
            </div>

            <div class="form-group">
                <label>No WhatsApp <span>*</span></label>
                <input type="text" name="no_wa" value="{{ old('no_wa', $pemilik->no_wa) }}">
            </div>

            <div class="form-group">
                <label>Alamat <span>*</span></label>
                <textarea name="alamat">{{ old('alamat', $pemilik->alamat) }}</textarea>
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.pemilik.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Update</button>
            </div>

        </form>

    </div>
</div>
@endsection
