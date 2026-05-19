@extends('layouts.app')

@section('title', 'Akun Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-key"></i> Akun Pengguna Siswa </h2>
    <a href="{{ route('akun-pengguna.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Buat Akun Baru
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Terakhir Login</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($akun as $a)
                    <tr>
                        <td><strong>{{ $a->username }}</strong></td>
                        <td>
                            @if($a->role == 'siswa')
                                <span class="badge bg-primary">Siswa</span>
                            @elseif($a->role == 'guru')
                                <span class="badge bg-info">Guru</span>
                            @else
                                <span class="badge bg-danger">Admin</span>
                            @endif
                        </td>
                        <td>
                            @if($a->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ $a->siswa->nama_siswa ?? '-' }}</td>
                        <td>{{ $a->siswa->nis ?? '-' }}</td>
                        <td>{{ $a->siswa->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $a->terakhir_login ? \Carbon\Carbon::parse($a->terakhir_login)->diffForHumans() : 'Belum pernah login' }}</td>
                        <td>
                            <a href="{{ route('akun-pengguna.edit', $a) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('akun-pengguna.destroy', $a) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus akun {{ $a->username }}?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1 d-block"></i>
                                Belum ada akun pengguna
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="alert alert-info mt-3">
    Setiap siswa hanya memiliki SATU akun pengguna, dan setiap akun hanya terhubung ke SATU siswa.
    <hr>
    <strong>Username bisa diubah</strong> - Klik tombol Edit pada akun yang ingin diubah usernamenya.
</div>
@endsection