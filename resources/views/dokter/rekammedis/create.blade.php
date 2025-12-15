{{-- resources/views/dokter/rekammedis/create.blade.php --}}
@extends('dokter.layouts.app')
@section('title', 'Input Rekam Medis')

@section('content')
<div class="form-page">
    <div class="form-card">

        <h2 class="form-title">Input Rekam Medis</h2>

        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dokter.rekammedis.store') }}" method="POST">
            @csrf

            <!-- Pilih Pet -->
            <div class="form-group">
                <label>Pilih Pet <span>*</span></label>
                <select name="idpet" class="form-control @error('idpet') is-invalid @enderror" required>
                    <option value="">-- Pilih Hewan --</option>
                    @foreach($pets as $pet)
                        <option value="{{ $pet->idpet }}" {{ old('idpet') == $pet->idpet ? 'selected' : '' }}>
                            {{ $pet->nama }} ({{ $pet->pemilik->user->nama ?? 'Tanpa Pemilik' }})
                        </option>
                    @endforeach
                </select>
                @error('idpet') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Dropdown Dokter Pemeriksa (idrole_user, bukan iduser) -->
            <div class="form-group">
                <label>Dokter Pemeriksa <span>*</span></label>
                <select name="dokter_pemeriksa" class="form-control @error('dokter_pemeriksa') is-invalid @enderror" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->idrole_user }}" {{ old('dokter_pemeriksa') == $dokter->idrole_user ? 'selected' : '' }}>
                            {{ $dokter->user->nama }}
                        </option>
                    @endforeach
                </select>
                @error('dokter_pemeriksa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Anamnesa -->
            <div class="form-group">
                <label>Anamnesa <span>*</span></label>
                <textarea name="anamnesa" rows="5" class="form-control @error('anamnesa') is-invalid @enderror"
                    placeholder="Keluhan dari pemilik, riwayat sakit, vaksinasi, dll...">{{ old('anamnesa') }}</textarea>
                @error('anamnesa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Temuan Klinis -->
            <div class="form-group">
                <label>Temuan Klinis <span>*</span></label>
                <textarea name="temuan_klinis" rows="5" class="form-control @error('temuan_klinis') is-invalid @enderror"
                    placeholder="Suhu, BB, RR, HR, CRT, mukosa, dll...">{{ old('temuan_klinis') }}</textarea>
                @error('temuan_klinis') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Diagnosa -->
            <div class="form-group">
                <label>Diagnosa <span>*</span></label>
                <textarea name="diagnosa" rows="5" class="form-control @error('diagnosa') is-invalid @enderror"
                    placeholder="Diagnosa utama, banding, rencana tindak lanjut...">{{ old('diagnosa') }}</textarea>
                @error('diagnosa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- DETAIL TINDAKAN – BISA TAMBAH BANYAK  -->
            <div class="tindakan-box">
                <h5>Detail Tindakan Terapi</h5>

                <div id="tindakan-container">
                    <!-- Baris pertama (default) -->
                    <div class="tindakan-row grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                        <div>
                            <label>Tindakan Terapi</label>
                            <select name="tindakan[]" class="form-control">
                                <option value="">-- Pilih Tindakan --</option>
                                @foreach($tindakans as $t)
                                    <option value="{{ $t->idkode_tindakan_terapi }}">
                                        {{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>Detail / Catatan</label>
                            <textarea name="detail[]" rows="3" class="form-control"
                                placeholder="Contoh: Amoxicillin 10 mg/kg BB PO BID x 7 hari"></textarea>
                        </div>
                    </div>
                </div>

                <button type="button" 
                        onclick="tambahTindakan()"
                        class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 
                            border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 
                            transition">
                    + Tambah Tindakan
                </button>
            </div>

            <div class="form-buttons mt-4">
                <a href="{{ route('dokter.rekammedis.index') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Simpan Rekam Medis</button>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk tambah baris tindakan --}}
<script>
function tambahTindakan() {
    const container = document.getElementById('tindakan-container');
    const template = container.querySelector('.tindakan-row');
    const clone = template.cloneNode(true);

    // Kosongkan nilai
    clone.querySelectorAll('select, textarea').forEach(el => el.value = '');

    // Tambahkan tombol hapus
    const btnHapus = document.createElement('button');
    btnHapus.type = 'button';
    btnHapus.innerHTML = '×';
    btnHapus.className = 'btn-hapus-tindakan';
    btnHapus.onclick = function() {
        // Minimal 1 baris harus tetap ada
        if (document.querySelectorAll('.tindakan-row').length > 1) {
            this.closest('.tindakan-row').remove();
        } else {
            alert('Minimal harus ada satu tindakan!');
        }
    };

    clone.appendChild(btnHapus);
    container.appendChild(clone);
}
</script>
@endsection