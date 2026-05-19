@extends('layouts.app')

@section('title', 'Tambah Mapel')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white"><h5 class="mb-0">Tambah Mata Pelajaran</h5></div>
    <div class="card-body">
        <form method="POST" action="{{ route('mata-pelajaran.store') }}">
            @csrf
            <div class="mb-3"><label>Kode Mapel</label><input type="text" name="kode_mapel" class="form-control" required></div>
            <div class="mb-3"><label>Nama Mapel</label><input type="text" name="nama_mapel" class="form-control" required></div>
            <div class="mb-3">
                <label>Guru Pengajar</label>
                <select name="id_guru" class="form-control">
                    <option value="">- Pilih Guru -</option>
                    @foreach($guru as $g)
                    <option value="{{ $g->id }}">{{ $g->nama_guru }} ({{ $g->nip }})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection