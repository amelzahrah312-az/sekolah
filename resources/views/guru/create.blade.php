@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Form Tambah Guru</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('guru.store') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">NIP <span class="text-danger">*</span></label>
                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" 
                       value="{{ old('nip') }}" required maxlength="20">
                @error('nip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Nomor Induk Pegawai </small>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama_guru" class="form-control @error('nama_guru') is-invalid @enderror" 
                       value="{{ old('nama_guru') }}" required maxlength="100">
                @error('nama_guru')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Pendidikan Terakhir</label>
                <select name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror">
                    <option value="">- Pilih Pendidikan -</option>
                    <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1 (Sarjana)</option>
                    <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>S2 (Magister)</option>
                    <option value="S3" {{ old('pendidikan_terakhir') == 'S3' ? 'selected' : '' }}>S3 (Doktor)</option>
                    <option value="D4" {{ old('pendidikan_terakhir') == 'D4' ? 'selected' : '' }}>D4 (Sarjana Terapan)</option>
                    <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3 (Ahli Madya)</option>
                </select>
                @error('pendidikan_terakhir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">No Telepon</label>
                <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" 
                       value="{{ old('no_telepon') }}" maxlength="15">
                @error('no_telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Contoh: 081234567890</small>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection