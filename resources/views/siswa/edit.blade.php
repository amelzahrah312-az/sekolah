@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="card">
    <div class="card-header bg-warning"><h5 class="mb-0">Edit Data Siswa</h5></div>
    <div class="card-body">
        <form method="POST" action="{{ route('siswa.update', $siswa) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3"><label>NIS</label><input type="text" name="nis" value="{{ $siswa->nis }}" class="form-control" required></div>
                    <div class="mb-3"><label>Nama</label><input type="text" name="nama_siswa" value="{{ $siswa->nama_siswa }}" class="form-control" required></div>
                    <div class="mb-3"><label>Tempat Lahir</label><input type="text" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}" class="form-control"></div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3"><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}" class="form-control"></div>
                    <div class="mb-3">
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-control">
                            <option value="">- Pilih Kelas -</option>
                            @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ $siswa->id_kelas == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3"><label>Alamat</label><textarea name="alamat" class="form-control" rows="3">{{ $siswa->alamat }}</textarea></div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection