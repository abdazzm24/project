{{-- resources/views/perawat/rekammedis/edit.blade.php --}}
@extends('perawat.layouts.app')
@section('title', 'Edit Rekam Medis')

@section('content')
<div class="detail-container">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
        <h1 class="detail-title">Edit Rekam Medis</h1>
        <a href="{{ route('perawat.rekammedis.show', $rekam->idrekam_medis) }}" class="btn-back">
            Batal
        </a>
    </div>

    <form action="{{ route('perawat.rekammedis.update', $rekam->idrekam_medis) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Informasi Umum -->
        <div class="detail-card">
            <div class="treatment-header">Informasi Umum</div>

            <div class="detail-row">
                <div class="detail-label-cell">Pet</div>
                <div class="detail-value-cell">
                    <select name="idpet" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                        <option value="">-- Pilih Pet --</option>
                        @foreach($pets as $pet)
                            <option value="{{ $pet->idpet }}"
                                {{ old('idpet', $rekam->idpet) == $pet->idpet ? 'selected' : '' }}>
                                {{ $pet->nama }} ({{ $pet->pemilik->user->nama ?? 'Tanpa Pemilik' }})
                            </option>
                        @endforeach
                    </select>
                    @error('idpet') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label-cell">Dokter Pemeriksa</div>
                <div class="detail-value-cell">
                    <select name="dokter_pemeriksa" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $dok)
                            <option value="{{ $dok->idrole_user }}"
                                {{ old('dokter_pemeriksa', $rekam->dokter_pemeriksa) == $dok->idrole_user ? 'selected' : '' }}>
                                {{ $dok->user->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('dokter_pemeriksa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="detail-row full">
                <div class="detail-label-cell">Keluhan (Anamnesa</div>
                <div class="detail-value-cell">
                    <textarea name="anamnesa" rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>{{ old('anamnesa', $rekam->anamnesa) }}</textarea>
                    @error('anamnesa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="detail-row full">
                <div class="detail-label-cell">Temuan Klinis</div>
                <div class="detail-value-cell">
                    <textarea name="temuan_klinis" rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>{{ old('temuan_klinis', $rekam->temuan_klinis) }}</textarea>
                    @error('temuan_klinis') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="detail-row full">
                <div class="detail-label-cell">Diagnosa</div>
                <div class="detail-value-cell">
                    <textarea name="diagnosa" rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>{{ old('diagnosa', $rekam->diagnosa) }}</textarea>
                    @error('diagnosa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Tindakan Terapi (bisa tambah/hapus) -->
        <div class="detail-card">
            <div class="treatment-header">Tindakan Terapi</div>
            <div id="tindakan-container">
                @forelse($rekam->details as $detail)
                    <div class="tindakan-item mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <select name="tindakan[]" class="px-4 py-2 border rounded-lg">
                                <option value="">-- Kosongkan jika ingin hapus --</option>
                                @foreach($tindakans as $t)
                                    <option value="{{ $t->idkode_tindakan_terapi }}"
                                        {{ $detail->idkode_tindakan_terapi == $t->idkode_tindakan_terapi ? 'selected' : '' }}>
                                        {{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="detail[]" value="{{ old('detail', $detail->detail) }}"
                                   placeholder="Catatan tambahan (opsional)" class="px-4 py-2 border rounded-lg">
                        </div>
                        <button type="button" onclick="this.closest('.tindakan-item').remove()"
                                class="mt-3 text-red-600 text-sm hover:underline">Hapus baris ini</button>
                    </div>
                @empty
                    <p class="text-gray-500 p-4">Belum ada tindakan terapi.</p>
                @endforelse
            </div>

            <button type="button" onclick="tambahTindakan()" class="mt-4 text-blue-600 hover:text-blue-800 font-medium">
                + Tambah Tindakan Baru
            </button>
        </div>

        <!-- Tombol Simpan -->
        <div class="text-right mt-10">
            <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg transition">
                Update Rekam Medis
            </button>
        </div>
    </form>
</div>

<script>
function tambahTindakan() {
    const container = document.getElementById('tindakan-container');
    const item = document.createElement('div');
    item.className = 'tindakan-item mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50';
    item.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <select name="tindakan[]" class="px-4 py-2 border rounded-lg">
                <option value="">-- Pilih Tindakan --</option>
                @foreach($tindakans as $t)
                    <option value="{{ $t->idkode_tindakan_terapi }}">{{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}</option>
                @endforeach
            </select>
            <input type="text" name="detail[]" placeholder="Catatan tambahan (opsional)" class="px-4 py-2 border rounded-lg">
        </div>
        <button type="button" onclick="this.closest('.tindakan-item').remove()" class="mt-3 text-red-600 text-sm hover:underline">
            Hapus baris ini
        </button>
    `;
    container.appendChild(item);
}
</script>
@endsection