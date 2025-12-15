{{-- resources/views/resepsionis/temudokter/index.blade.php --}}
@extends('resepsionis.layouts.app')

@section('title', 'Antrian Temu Dokter')

@section('content')
<div class="table-container">
    <h2 class="table-title">Antrian Temu Dokter</h2>

    @if(session('success'))
        <div class="alert alert-success mb-10">{{ session('success') }}</div>
    @endif

    <!-- Form Tambah Antrian -->
    <div class="custom-card card-tambah-antrian">
        <div class="card-body">
            <form action="{{ route('resepsionis.temudokter.store') }}" method="POST">
                @csrf
                <div class="row g-4 align-items-end">
                    <div class="col-12 col-md-6">
                        <select name="idpet" class="custom-select" required>
                            <option value="">Pilih Pet</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->idpet }}">
                                    {{ $pet->nama }} - {{ $pet->pemilik?->user?->nama ?? 'Tanpa Pemilik' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-5">
                        <select name="idrole_user" class="custom-select" required>
                            <option value="">Pilih Dokter</option>
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->idrole_user }}">{{ $dokter->user?->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-1">
                        <button type="submit" class="btn-tambah-antrian w-100">+ tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Filter Tanggal -->
    <div class="custom-card card-filter-tanggal">
        <div class="card-body">
            <form method="GET" class="filter-form">
                <div>
                    <input type="date" name="date" class="custom-input-date" value="{{ $date !== 'all' ? $date : '' }}">
                </div>
                <div>
                    <button type="submit" class="btn-filter">Filter</button>
                </div>
                <div>
                    <a href="{{ route('resepsionis.temudokter.index', ['date' => 'all']) }}" class="btn-lihat-semua">
                        Lihat Semua
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Antrian -->
    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Nama Pet</th>
                    <th>Nama Dokter</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($antrian as $a)
                    <tr>
                        <td class="fw-bold">{{ $a->no_urut }}</td>
                        <td>{{ $a->pet?->nama ?? '-' }}</td>
                        <td>{{ $a->roleuser?->user?->nama ?? '-' }}</td>
                        <td>{{ $a->waktu_daftar?->format('Y-m-d') ?? '-' }}</td>
                        <td>
                            @if(trim($a->STATUS ?? '') === 'M')
                            <span class="badge-waiting">Menunggu</span>
                            @else
                            <span class="badge-done">Selesai</span>
                            @endif
                        </td>
                        <td>
                            @if(trim($a->STATUS ?? '') === 'M')
                                <form action="{{ route('resepsionis.temudokter.selesai', $a->idreservasi_dokter) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST') <!-- kalau pakai route model binding biasanya butuh ini -->
                                    <button type="submit" class="btn-action-waiting">
                                        Tandai Selesai
                                    </button>
                                </form>
                            @else
                                <span class="badge-success">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada antrian untuk tanggal ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection