@extends('perawat.layouts.app')

@section('content')
<div class="table-container">
    <h2 class="table-title">Rekam Medis</h2>

    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pet</th>
                    <th>Pemilik</th>
                    <th>Keluhan</th>
                    <th>Temuan Klinis</th>
                    <th>Diagnosa</th>
                    <th>Dokter</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekamMedis as $index => $r)
                    <tr>
                        <td>{{ $r->created_at ? $r->created_at->format('d-m-Y') : '-' }}</td>
                        <td>{{ $r->pet->nama }}</td>
                        <td>{{ $r->pet->pemilik->user->nama }}</td>
                        <td>{{ $r->anamnesa }}</td>
                        <td>{{ $r->temuan_klinis }}</td>
                        <td>{{ $r->diagnosa }}</td>
                        <td>{{ $r->dokter->user->nama }}</td>
                        <td>
                            <a href="{{ route('perawat.rekammedis.show', $r->idrekam_medis) }}" class="text-blue-600 hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection