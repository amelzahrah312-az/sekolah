@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="card mb-3">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="bi bi-person"></i> Detail Siswa: {{ $siswa->nama_siswa }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr><th width="150">NIS</th><td>{{ $siswa->nis }}</td></tr>
                    <tr><th>Nama Lengkap</th><td>{{ $siswa->nama_siswa }}</td></tr>
                    <tr><th>Tempat, Tgl Lahir</th><td>{{ $siswa->tempat_lahir ?: '-' }}, {{ $siswa->tanggal_lahir ?: '-' }}</td></tr>
                    <tr><th>Alamat</th><td>{{ $siswa->alamat ?: '-' }}</td></tr>
                    <tr><th>Kelas</th><td>{{ $siswa->kelas->nama_kelas ?? '-' }} ({{ $siswa->kelas->tingkat ?? '-' }})</td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr><th width="150">Status Akun</th>
                        <td>
                            @if($siswa->akun)
                                <span class="badge bg-success">✓ Aktif ({{ $siswa->akun->username }})</span>
                            @else
                                <span class="badge bg-danger">✗ Belum punya akun</span>
                                <a href="{{ route('akun-pengguna.create') }}?siswa_id={{ $siswa->id }}" class="btn btn-sm btn-primary">Buat Akun</a>
                            @endif
                        </td>
                    </tr>
                    <tr><th>Rata-rata Nilai</th><td><strong>{{ $siswa->rata_rata_nilai ?? 'Belum ada nilai' }}</strong></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-book"></i> Mata Pelajaran yang Diambil (Many-to-Many)</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <tr><th>Kode</th><th>Mata Pelajaran</th><th>Guru</th><th>Tahun</th><th>Semester</th><th>Nilai Akhir</th><th>Predikat</th></tr>
            </thead>
            <tbody>
                @forelse($siswa->siswaMapels as $sm)
                <tr>
                    <td>{{ $sm->mataPelajaran->kode_mapel ?? '-' }}</td>
                    <td>{{ $sm->mataPelajaran->nama_mapel ?? '-' }}</td>
                    <td>{{ $sm->mataPelajaran->guru->nama_guru ?? '-' }}</td>
                    <td>{{ $sm->tahun_ajaran }}</td>
                    <td>{{ $sm->semester }}</td>
                    <td>{{ $sm->nilai->nilai_akhir ?? '-' }}</td>
                    <td>{{ $sm->nilai->predikat ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">Belum mengambil mata pelajaran apapun</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection