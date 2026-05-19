@extends('layouts.app')

@section('title', 'Edit Akun')

@section('content')
<div class="card">
    <div class="card-header bg-warning">
        <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Akun: {{ $akun_pengguna->username }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('akun-pengguna.update', $akun_pengguna) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Siswa Terkait</label>
                <input type="text" class="form-control" value="{{ $akun_pengguna->siswa->nama_siswa ?? '-' }}" disabled>
                <small class="text-muted">Siswa tidak bisa diubah setelah akun dibuat</small>
            </div>
            
            <div class="mb-3">
                <label>Username <span class="text-danger">*</span></label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                       value="{{ old('username', $akun_pengguna->username) }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Username bisa diubah kapan saja</small>
            </div>
            
            <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Kosongkan jika tidak ingin mengubah password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 4 karakter</small>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="siswa" {{ $akun_pengguna->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="guru" {{ $akun_pengguna->role == 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="admin" {{ $akun_pengguna->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="aktif" {{ $akun_pengguna->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ $akun_pengguna->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update Akun
                </button>
                <a href="{{ route('akun-pengguna.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<div class="alert alert-info mt-3">
    <strong><i class="bi bi-info-circle"></i> Informasi:</strong>
    <ul class="mb-0 mt-2">
        <li><strong>Username</strong> - Bisa diubah kapan saja</li>
        <li><strong>Password</strong> - Isi hanya jika ingin mengganti password</li>
        <li><strong>Role</strong> - Menentukan hak akses (siswa/guru/admin)</li>
        <li><strong>Status</strong> - Nonaktifkan akun jika siswa pindah/lulus</li>
    </ul>
</div>
@endsection