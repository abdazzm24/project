@extends('admin.layouts.crud')
@section('title', 'Edit Kode Tindakan Terapi')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Edit Kode Tindakan</h2>

        <form action="{{ route('admin.kodetindakan.update', $kode->idkode_tindakan_terapi) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Kode <span>*</span></label>
                <input type="text" name="kode"
                       value="{{ old('kode', $kode->kode) }}"
                       class="@error('kode') is-invalid @enderror">
                @error('kode')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Deskripsi Tindakan Terapi <span>*</span></label>
                <input type="text" name="deskripsi_tindakan_terapi"
                       value="{{ old('deskripsi_tindakan_terapi', $kode->deskripsi_tindakan_terapi) }}"
                       class="@error('deskripsi_tindakan_terapi') is-invalid @enderror">
                @error('deskripsi_tindakan_terapi')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Kategori <span>*</span></label>
                <select name="idkategori" class="@error('idkategori') is-invalid @enderror">
                    @foreach($kategori as $k)
                        <option value="{{ $k->idkategori }}"
                            @if($k->idkategori == $kode->idkategori) selected @endif>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Kategori Klinis <span>*</span></label>
                <select name="idkategori_klinis" class="@error('idkategori_klinis') is-invalid @enderror">
                    @foreach($kategoriKlinis as $kk)
                        <option value="{{ $kk->idkategori_klinis }}"
                            @if($kk->idkategori_klinis == $kode->idkategori_klinis) selected @endif>
                            {{ $kk->nama_kategori_klinis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.kodetindakan.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Update</button>
            </div>

        </form>

    </div>
</div>
@endsection
