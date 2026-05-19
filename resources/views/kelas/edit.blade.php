@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')
<div class="card">
    <div class="card-header bg-warning">
        <h5 class="mb-0"><i class="bi bi-pencil"></i> Form Edit Kelas</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('kelas.update', $kelas->id) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" 
                       value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required maxlength="10">
                @error('nama_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tingkat <span class="text-danger">*</span></label>
                <select name="tingkat" class="form-control @error('tingkat') is-invalid @enderror" required>
                    <option value="X" {{ $kelas->tingkat == 'X' ? 'selected' : '' }}>X (Sepuluh)</option>
                    <option value="XI" {{ $kelas->tingkat == 'XI' ? 'selected' : '' }}>XI (Sebelas)</option>
                    <option value="XII" {{ $kelas->tingkat == 'XII' ? 'selected' : '' }}>XII (Dua Belas)</option>
                </select>
                @error('tingkat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                <select name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" required>
                    <option value="">- Pilih Jurusan -</option>
                    <option value="PPLG" {{ $kelas->jurusan == 'PPLG' ? 'selected' : '' }}>PPLG (Pengembangan Perangkat Lunak dan Gim)</option>
                    <option value="DKV" {{ $kelas->jurusan == 'DKV' ? 'selected' : '' }}>DKV (Desain Komunikasi Visual)</option>
                    <option value="PH" {{ $kelas->jurusan == 'PH' ? 'selected' : '' }}>PH (Perhotelan)</option>
                    <option value="KLN" {{ $kelas->jurusan == 'KLN' ? 'selected' : '' }}>KLN (Kuliner)</option>
                    <option value="KCS" {{ $kelas->jurusan == 'KCS' ? 'selected' : '' }}>KCS (Kecantikan dan Spa)</option>
                    <option value="TBS" {{ $kelas->jurusan == 'TBS' ? 'selected' : '' }}>TBS (Tata Busana)</option>
                </select>
                @error('jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection