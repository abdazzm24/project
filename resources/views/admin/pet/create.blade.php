@extends('admin.layouts.crud')
@section('title', 'Tambah Pet')

@section('content')
<div class="form-page">
    <div class="form-card">
        <h2 class="form-title">Tambah Pet</h2>

        <form action="{{ route('admin.pet.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Pemilik <span>*</span></label>
                <select name="idpemilik" class="form-control @error('idpemilik') is-invalid @enderror">
                    <option value="">-- Pilih Pemilik --</option>
                    @foreach($pemilik as $p)
                        <option value="{{ $p->idpemilik }}" {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                            {{ $p->user->nama }} ({{ $p->no_wa }})
                        </option>
                    @endforeach
                </select>
                @error('idpemilik') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Ras Hewan <span>*</span></label>
                <select name="idras_hewan" class="form-control @error('idras_hewan') is-invalid @enderror">
                    <option value="">-- Pilih Ras --</option>
                    @foreach($rasHewan as $r)
                        <option value="{{ $r->idras_hewan }}" {{ old('idras_hewan') == $r->idras_hewan ? 'selected' : '' }}>
                            {{ $r->nama_ras }} - {{ $r->jenisHewan->nama_jenis_hewan ?? 'Umum' }}
                        </option>
                    @endforeach
                </select>
                @error('idras_hewan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Nama Pet <span>*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="@error('nama') is-invalid @enderror">
                @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Lahir <span>*</span></label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="@error('tanggal_lahir') is-invalid @enderror">
                @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Warna Tanda</label>
                <input type="text" name="warna_tanda" value="{{ old('warna_tanda') }}" class="@error('warna_tanda') is-invalid @enderror">
                @error('warna_tanda') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Jenis Kelamin <span>*</span></label>
                <select name="jenis_kelamin" class="@error('jenis_kelamin') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="Jantan" {{ old('jenis_kelamin') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="Betina" {{ old('jenis_kelamin') == 'Betina' ? 'selected' : '' }}>Betina</option>
                </select>
                @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.pet.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection