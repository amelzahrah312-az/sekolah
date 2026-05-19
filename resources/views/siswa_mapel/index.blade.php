@extends('layouts.app')

@section('title', 'Pendaftaran Mapel Siswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-link"></i> Pendaftaran Mata Pelajaran Siswa</h2>
    <a href="{{ route('siswa-mapel.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Daftarkan Mapel</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>NIS</th>
                    <th>Siswa</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Tahun</th>
                    <th>Semester</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftaran as $p)
                <tr>
                    <td>{{ $p->siswa->nis ?? '-' }}</td>
                    <td><strong>{{ $p->siswa->nama_siswa ?? '-' }}</strong></td>
                    <td>{{ $p->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $p->mataPelajaran->nama_mapel ?? '-' }} ({{ $p->mataPelajaran->kode_mapel ?? '-' }})</td>
                    <td>{{ $p->mataPelajaran->guru->nama_guru ?? '-' }}</td>
                    <td>{{ $p->tahun_ajaran }}</td>
                    <td>{{ $p->semester }}</td>
                    <td>
                        @if($p->nilai)
                            <span class="badge bg-success">{{ $p->nilai->nilai_akhir ?? '-' }}</span>
                        @else
                            <span class="badge bg-warning">Belum input</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('siswa-mapel.edit', $p) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('siswa-mapel.destroy', $p) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pendaftaran ini?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada data pendaftaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>

<div class="alert alert-info mt-3">
    Satu siswa bisa mengambil banyak mapel, satu mapel bisa diambil banyak siswa.
</div>
@endsection