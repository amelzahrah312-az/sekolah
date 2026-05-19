@extends('layouts.app')

@section('title', 'Data Nilai')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-graph-up"></i> Data Nilai Siswa</h2>
    <a href="{{ route('nilai.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Input Nilai</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Siswa</th><th>NIS</th><th>Kelas</th><th>Mapel</th>
                    <th>UH1</th><th>UH2</th><th>UTS</th><th>UAS</th>
                    <th>Nilai Akhir</th><th>Predikat</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($nilai as $n)
                <tr>
                    <td>{{ $n->siswaMapel->siswa->nama_siswa ?? '-' }}</td>
                    <td>{{ $n->siswaMapel->siswa->nis ?? '-' }}</td>
                    <td>{{ $n->siswaMapel->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $n->siswaMapel->mataPelajaran->nama_mapel ?? '-' }}</td>
                    <td>{{ $n->nilai_uh1 ?? '-' }}</td>
                    <td>{{ $n->nilai_uh2 ?? '-' }}</td>
                    <td>{{ $n->nilai_uts ?? '-' }}</td>
                    <td>{{ $n->nilai_uas ?? '-' }}</td>
                    <td><strong>{{ $n->nilai_akhir ?? '-' }}</strong></td>
                    <td><span class="badge bg-{{ $n->predikat == 'A' ? 'success' : ($n->predikat == 'B' ? 'primary' : ($n->predikat == 'C' ? 'warning' : 'danger')) }}">{{ $n->predikat ?? '-' }}</span></td>
                    <td>
                        <a href="{{ route('nilai.edit', $n) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('nilai.destroy', $n) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="11" class="text-center">Belum ada data nilai</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection