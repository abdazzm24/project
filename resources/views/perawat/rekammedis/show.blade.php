{{-- resources/views/perawat/rekammedis/show.blade.php --}}
@extends('perawat.layouts.app')
@section('title', 'Detail Rekam Medis')

@section('content')
    <div class="detail-container">

        <!-- Header Halaman -->
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px;">
            <h1 class="detail-title">Detail Rekam Medis</h1>
            <a href="{{ route('perawat.rekammedis.index') }}" class="btn-back">Kembali ke Daftar</a>
        </div>

        <!-- INFORMASI REKAM MEDIS -->
        <div class="section-title">Informasi Rekam Medis</div>
        <div class="detail-card">

            <div class="detail-row">
                <div class="detail-label-cell">ID Rekam Medis</div>
                <div class="detail-value-cell">{{ $rekam->idrekam_medis }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label-cell">Tanggal</div>
                <div class="detail-value-cell">{{ $rekam->created_at?->format('d F Y H:i') ?? '-' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label-cell">Pet</div>
                <div class="detail-value-cell">{{ $rekam->pet->nama }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label-cell">Pemilik</div>
                <div class="detail-value-cell">{{ $rekam->pet->pemilik->user->nama ?? '-' }}</div>
            </div>
            <div class="detail-row full">
                <div class="detail-label-cell">Keluhan (Anamnesa)</div>
                <div class="detail-value-cell">{!! nl2br(e($rekam->anamnesa ?? '-')) !!}</div>
            </div>
            <div class="detail-row full">
                <div class="detail-label-cell">Temuan Klinis</div>
                <div class="detail-value-cell">{!! nl2br(e($rekam->temuan_klinis ?? '-')) !!}</div>
            </div>
            <div class="detail-row full">
                <div class="detail-label-cell">Diagnosa</div>
                <div class="detail-value-cell">{!! nl2br(e($rekam->diagnosa ?? '-')) !!}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label-cell">Dokter Pemeriksa</div>
                <div class="detail-value-cell">{{ $rekam->dokter->user->nama ?? '-' }}</div>
            </div>
        </div>

        <!-- TINDAKAN TERAPI -->
        <div class="section-title">Tindakan Terapi</div>

        @forelse($rekam->details as $i => $d)
            <div class="detail-card">
                <div class="treatment-header">Tindakan #{{ $i + 1 }}</div>

                <div class="detail-row">
                    <div class="detail-label-cell">Kode</div>
                    <div class="detail-value-cell">
                        <code>{{ $d->tindakan->kode ?? '-' }}</code>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label-cell">Kategori</div>
                    <div class="detail-value-cell">
                        {{ $d->tindakan->kategori->nama_kategori ?? '-' }}
                        @if($d->tindakan->kategoriKlinis)
                            <span style="color:#64748b;"> ({{ $d->tindakan->kategoriKlinis->nama_kategori_klinis }})</span>
                        @endif
                    </div>
                </div>

                <div class="detail-row full">
                    <div class="detail-label-cell">Deskripsi</div>
                    <div class="detail-value-cell">
                        {{ $d->tindakan->deskripsi_tindakan_terapi ?? '-' }}
                    </div>
                </div>

                <div class="detail-row full">
                    <div class="detail-label-cell">Detail / Catatan</div>
                    <div class="detail-value-cell">
                        {!! $d->detail ? nl2br(e($d->detail)) : '<em style="color:#94a3b8;">Tanpa catatan</em>' !!}
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                Belum ada tindakan terapi yang dicatat.
            </div>
        @endforelse

        <!-- TOMBOLEDIT & DELETE – HANYA UNTUK PERAWAT, DI BAWAH SENDIRI -->
        <div style="margin-top: 40px; text-align: right;">
            <a href="{{ route('perawat.rekammedis.edit', $rekam->idrekam_medis) }}"
            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">
                <i class="fa fa-edit mr-2"></i> Edit Rekam Medis
            </a>

            <form action="{{ route('perawat.rekammedis.destroy', $rekam->idrekam_medis) }}" 
                method="POST" class="inline ml-4"
                onsubmit="return confirm('Yakin ingin menghapus rekam medis ini? Data tidak bisa dikembalikan!');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transition">
                    <i class="fa fa-trash-alt mr-2"></i> Hapus Rekam Medis
                </button>
            </form>
        </div>

    </div>
@endsection