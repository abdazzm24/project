{{-- resources/views/dokter/rekammedis/show.blade.php --}}
@extends('dokter.layouts.app')
@section('title', 'Detail Rekam Medis')

@section('content')
    <div class="detail-container">

        <!-- Header Halaman -->
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px;">
            <h1 class="detail-title">Detail Rekam Medis</h1>
            <a href="{{ route('dokter.rekammedis.index') }}" class="btn-back">Kembali ke Daftar</a>
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

    </div>
@endsection