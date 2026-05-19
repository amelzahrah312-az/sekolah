@extends('layouts.app')

@section('title', 'Detail Kelas')

@section('content')
<div class="card mb-3">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="bi bi-building"></i> Detail Kelas: {{ $kelas->nama_kelas }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="150">Nama Kelas</th>
                        <td><strong>{{ $kelas->nama_kelas }}</strong></td>
                    </tr>
                    <tr>
                        <th>Tingkat</th>
                        <td>
                            @if($kelas->tingkat == 'X')
                                X (Sepuluh)
                            @elseif($kelas->tingkat == 'XI')
                                XI (Sebelas)
                            @else
                                XII (Dua Belas)
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
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
                            {{ $jurusanMap[$kelas->jurusan] ?? $kelas->jurusan ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah Siswa</th>
                        <td>
                            <span class="badge bg-primary">{{ $kelas->siswas ? $kelas->siswas->count() : 0 }} siswa</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-people"></i> Daftar Siswa di Kelas {{ $kelas->nama_kelas }}</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Tempat, Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>Status Akun</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelas->siswas as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa->nis }}</td>
                        <td><strong>{{ $siswa->nama_siswa }}</strong></td>
                        <td>{{ $siswa->tempat_lahir ?: '-' }}, {{ $siswa->tanggal_lahir ?: '-' }}</td>
                        <td>{{ $siswa->alamat ?: '-' }}</td>
                        <td>
                            @if($siswa->akun)
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle"></i> {{ $siswa->akun->username }}
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle"></i> Belum punya akun
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-1 d-block"></i>
                            Belum ada siswa di kelas ini
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kelas
    </a>
    <a href="{{ route('kelas.edit', $kelas->id) }}" class="btn btn-warning">
        <i class="bi bi-pencil"></i> Edit Kelas
    </a>
</div>
@endsection