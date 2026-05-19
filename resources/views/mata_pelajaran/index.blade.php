@extends('layouts.app')

@section('title', 'Data Mata Pelajaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-book"></i> Data Mata Pelajaran</h2>
    <a href="{{ route('mata-pelajaran.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Mapel
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>Kode Mapel</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Guru Pengajar</th>
                        <th>Jumlah Siswa</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mapel as $index => $m)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $m->kode_mapel }}</strong></td>
                        <td>{{ $m->nama_mapel }}</td>
                        <td>
                            @if($m->guru)
                                {{ $m->guru->nama_guru }}
                            @else
                                <span class="text-muted">- Belum ada guru -</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $jumlahSiswa = $m->siswas ? $m->siswas->count() : 0;
                            @endphp
                            {{ $jumlahSiswa }} Siswa
                        </td>
                        <td>
                            <a href="{{ route('mata-pelajaran.edit', $m->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('mata-pelajaran.destroy', $m->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus mata pelajaran {{ $m->nama_mapel }}?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-1 d-block"></i>
                            Belum ada data mata pelajaran
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Statistik Mata Pelajaran -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik Mata Pelajaran</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="alert alert-primary">
                            <strong>Total Mata Pelajaran</strong>
                            <h4>{{ $mapel->count() }}</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-warning">
                            <strong>Total Guru Pengajar</strong>
                            <h4>
                                @php
                                    $totalGuru = $mapel->where('id_guru', '!=', null)->count();
                                @endphp
                                {{ $totalGuru }} Guru
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-danger">
                            <strong>Total Pendaftaran Siswa</strong>
                            <h4>
                                @php
                                    $totalPendaftaran = $mapel->sum(function($m) {
                                        return $m->siswas ? $m->siswas->count() : 0;
                                    });
                                @endphp
                                {{ $totalPendaftaran }} Pendaftar
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection