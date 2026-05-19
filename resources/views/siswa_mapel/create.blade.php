@extends('layouts.app')

@section('title', 'Daftarkan Mapel ke Siswa')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-link"></i> Form Pendaftaran Mata Pelajaran</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('siswa-mapel.store') }}">
            @csrf
            <div class="mb-3">
                <label>Pilih Siswa <span class="text-danger">*</span></label>
                <select name="id_siswa" class="form-control @error('id_siswa') is-invalid @enderror" required>
                    <option value="">- Pilih Siswa -</option>
                    @foreach($siswa as $s)
                    <option value="{{ $s->id }}">{{ $s->nama_siswa }} (NIS: {{ $s->nis }} - Kelas: {{ $s->kelas->nama_kelas ?? '-' }})</option>
                    @endforeach
                </select>
                @error('id_siswa')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="mb-3">
                <label>Pilih Mata Pelajaran <span class="text-danger">*</span></label>
                <select name="id_mapel" class="form-control @error('id_mapel') is-invalid @enderror" required>
                    <option value="">- Pilih Mapel -</option>
                    @foreach($mapel as $m)
                    <option value="{{ $m->id }}">{{ $m->nama_mapel }} ({{ $m->kode_mapel }}) - Guru: {{ $m->guru->nama_guru ?? '-' }}</option>
                    @endforeach
                </select>
                @error('id_mapel')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control"required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Daftarkan</button>
            <a href="{{ route('siswa-mapel.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection