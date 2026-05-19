@extends('layouts.app')

@section('title', 'Edit Pendaftaran Mapel')

@section('content')
<div class="card">
    <div class="card-header bg-warning"><h5 class="mb-0">Edit Pendaftaran Mapel</h5></div>
    <div class="card-body">
        <form method="POST" action="{{ route('siswa-mapel.update', $siswa_mapel) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Siswa</label>
                <select name="id_siswa" class="form-control" required>
                    @foreach($siswa as $s)
                    <option value="{{ $s->id }}" {{ $siswa_mapel->id_siswa == $s->id ? 'selected' : '' }}>{{ $s->nama_siswa }} ({{ $s->nis }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Mata Pelajaran</label>
                <select name="id_mapel" class="form-control" required>
                    @foreach($mapel as $m)
                    <option value="{{ $m->id }}" {{ $siswa_mapel->id_mapel == $m->id ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-6"><input type="text" name="tahun_ajaran" value="{{ $siswa_mapel->tahun_ajaran }}" class="form-control" required></div>
                <div class="col-md-6">
                    <select name="semester" class="form-control">
                        <option {{ $siswa_mapel->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option {{ $siswa_mapel->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a href="{{ route('siswa-mapel.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>
@endsection