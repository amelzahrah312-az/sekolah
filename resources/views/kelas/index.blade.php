@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-building"></i> Data Kelas</h2>
    <a href="{{ route('kelas.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Kelas
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Kelas</th>
                        <th>Tingkat</th>
                        <th>Jurusan</th>
                        <th>Jumlah Siswa</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelas as $index => $k)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $k->nama_kelas }}</strong></td>
                        <td>
                            @if($k->tingkat == 'X')
                                X (Sepuluh)
                            @elseif($k->tingkat == 'XI')
                                XI (Sebelas)
                            @else
                                XII (Dua Belas)
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
                            @if($k->jurusan && isset($jurusanMap[$k->jurusan]))
                                {{ $jurusanMap[$k->jurusan] }}
                            @else
                                <span class="text-muted">{{ $k->jurusan ?? '-' }}</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $jumlah = $k->siswas ? $k->siswas->count() : 0;
                            @endphp
                            {{ $jumlah }} Siswa
                        </td>
                        <td>
                            <a href="{{ route('kelas.show', $k->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus kelas {{ $k->nama_kelas }}?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
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

<!-- Statistik Kelas -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik Kelas</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="alert alert-primary">
                            <strong>Total Kelas</strong>
                            <h4>{{ $kelas->count() }}</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-warning">
                            <strong>Total Siswa</strong>
                            <h4>{{ $kelas->sum(function($k) { return $k->siswas ? $k->siswas->count() : 0; }) }}</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-danger">
                            <strong>Rata-rata Siswa per Kelas</strong>
                            <h4>
                                @php
                                    $totalSiswa = $kelas->sum(function($k) { return $k->siswas ? $k->siswas->count() : 0; });
                                    $rata = $kelas->count() > 0 ? round($totalSiswa / $kelas->count(), 1) : 0;
                                @endphp
                                {{ $rata }} Siswa
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection