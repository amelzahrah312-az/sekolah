@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Form Tambah Kelas</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('kelas.store') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" 
                       value="{{ old('nama_kelas') }}" required maxlength="10" placeholder="Contoh: A, B, C, D, E atau F">
                @error('nama_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tingkat <span class="text-danger">*</span></label>
                <select name="tingkat" class="form-control @error('tingkat') is-invalid @enderror" required>
                    <option value="X" {{ old('tingkat') == 'X' ? 'selected' : '' }}>X (Sepuluh)</option>
                    <option value="XI" {{ old('tingkat') == 'XI' ? 'selected' : '' }}>XI (Sebelas)</option>
                    <option value="XII" {{ old('tingkat') == 'XII' ? 'selected' : '' }}>XII (Dua Belas)</option>
                </select>
                @error('tingkat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                <select name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" required>
                    <option value="">- Pilih Jurusan -</option>
                    <option value="PPLG" {{ old('jurusan') == 'PPLG' ? 'selected' : '' }}>PPLG (Pengembangan Perangkat Lunak dan Gim)</option>
                    <option value="DKV" {{ old('jurusan') == 'DKV' ? 'selected' : '' }}>DKV (Desain Komunikasi Visual)</option>
                    <option value="PH" {{ old('jurusan') == 'PH' ? 'selected' : '' }}>PH (Perhotelan)</option>
                    <option value="KLN" {{ old('jurusan') == 'KLN' ? 'selected' : '' }}>KLN (Kuliner)</option>
                    <option value="KCS" {{ old('jurusan') == 'KCS' ? 'selected' : '' }}>KCS (Kecantikan dan Spa)</option>
                    <option value="TBS" {{ old('jurusan') == 'TBS' ? 'selected' : '' }}>TBS (Tata Busana)</option>
                </select>
                @error('jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Jurusan untuk Sekolah Menengah Kejuruan (SMK)</small>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<div class="alert alert-info mt-3">
    <strong><i class="bi bi-info-circle"></i> Informasi Jurusan SMK:</strong>
    <ul class="mb-0 mt-2">
        <li><strong>PPLG</strong> - Pengembangan Perangkat Lunak dan Gim</li>
        <li><strong>DKV</strong> - Desain Komunikasi Visual</li>
        <li><strong>PH</strong> - Perhotelan</li>
        <li><strong>KLN</strong> - Kuliner</li>
        <li><strong>KCS</strong> - Kecantikan dan Spa</li>
        <li><strong>TBS</strong> - Tata Busana</li>
    </ul>
</div>
@endsection