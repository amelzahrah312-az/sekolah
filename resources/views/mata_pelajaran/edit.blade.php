@extends('layouts.app')

@section('title', 'Edit Mapel')

@section('content')
<div class="card">
    <div class="card-header bg-warning"><h5 class="mb-0">Edit Mata Pelajaran</h5></div>
    <div class="card-body">
        <form method="POST" action="{{ route('mata-pelajaran.update', $mata_pelajaran) }}">
            @csrf @method('PUT')
            <div class="mb-3"><label>Kode Mapel</label><input type="text" name="kode_mapel" value="{{ $mata_pelajaran->kode_mapel }}" class="form-control" required></div>
            <div class="mb-3"><label>Nama Mapel</label><input type="text" name="nama_mapel" value="{{ $mata_pelajaran->nama_mapel }}" class="form-control" required></div>
            <div class="mb-3">
                <label>Guru Pengajar</label>
                <select name="id_guru" class="form-control">
                    <option value="">- Pilih Guru -</option>
                    @foreach($guru as $g)
                    <option value="{{ $g->id }}" {{ $mata_pelajaran->id_guru == $g->id ? 'selected' : '' }}>{{ $g->nama_guru }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection