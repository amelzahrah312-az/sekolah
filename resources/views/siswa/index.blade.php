@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-people"></i> Data Siswa</h2>
    <a href="{{ route('siswa.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Siswa</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $s)
                <tr>
                    <td>{{ $s->nis }}</td>
                    <td><strong>{{ $s->nama_siswa }}</strong></td>
                    <td>{{ $s->kelas->nama_kelas ?? '-' }} ({{ $s->kelas->tingkat ?? '-' }})</td>
                    <td>
                        @if($s->akun)
                            <span class="badge bg-success"><i class="bi bi-check-circle"></i> {{ $s->akun->username }}</span>
                        @else
                            <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Belum punya akun</span>
                            <a href="{{ route('akun-pengguna.create') }}" class="btn btn-sm btn-primary mt-1">Buat Akun</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('siswa.show', $s) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('siswa.edit', $s) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('siswa.destroy', $s) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus siswa {{ $s->nama_siswa }}? Semua data terkait akan ikut terhapus.')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Belum ada data siswa</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection