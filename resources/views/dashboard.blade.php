@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-speedometer2"></i> Dashboard</h1>
    <p class="text-muted">Selamat datang di Sistem Informasi Sekolah</p>
</div>

<!-- Statistik Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card card-stats bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Kelas</h5>
                        <h2 class="mb-0">{{ $stats['kelas'] }}</h2>
                    </div>
                    <i class="bi bi-building fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-stats bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Guru</h5>
                        <h2 class="mb-0">{{ $stats['guru'] }}</h2>
                    </div>
                    <i class="bi bi-person-badge fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-stats bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Mata Pelajaran</h5>
                        <h2 class="mb-0">{{ $stats['mapel'] }}</h2>
                    </div>
                    <i class="bi bi-book fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-stats bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Siswa</h5>
                        <h2 class="mb-0">{{ $stats['siswa'] }}</h2>
                    </div>
                    <i class="bi bi-people fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Kelas -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-building"></i> Data Kelas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Kelas</th>
                                <th>Tingkat</th>
                                <th>Jurusan</th>
                                <th>Jumlah Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelasData as $index => $k)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $k->nama_kelas }}</strong></td>
                                <td>
                                    @if($k->tingkat == 'X')
                                        <span class="badge bg-primary">X</span>
                                    @elseif($k->tingkat == 'XI')
                                        <span class="badge bg-info">XI</span>
                                    @else
                                        <span class="badge bg-success">XII</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $jurusanMap = [
                                            'PPLG' => 'PPLG (Pengembangan Perangkat Lunak dan Gim)',
                                            'DKV' => 'DKV (Desain Komunikasi Visual)',
                                            'PH' => 'PH (Perhotelan)',
                                            'KLN' => 'KLN (Kuliner)',
                                            'KCS' => 'KCS (Kecantikan dan Spa)',
                                            'TBS' => 'TBS (Tata Busana)',
                                        ];
                                    @endphp
                                    {{ $jurusanMap[$k->jurusan] ?? $k->jurusan ?? '-' }}
                                </td>
                                <td>
                                    @php
                                        $jumlah = $k->siswas ? $k->siswas->count() : 0;
                                    @endphp
                                    <span class="badge bg-primary">{{ $jumlah }} Siswa</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-1 d-block"></i>
                                    Belum ada data kelas
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection