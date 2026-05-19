@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white"><h5 class="mb-0">Form Tambah Siswa</h5></div>
    <div class="card-body">
        <form method="POST" action="{{ route('siswa.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3"><label>NIS</label><input type="text" name="nis" class="form-control" required></div>
                    <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama_siswa" class="form-control" required></div>
                    <div class="mb-3"><label>Tempat Lahir</label><input type="text" name="tempat_lahir" class="form-control"></div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3"><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control"></div>
                    <div class="mb-3">
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-control">
                            <option value="">- Pilih Kelas -</option>
                            @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }} ({{ $k->tingkat }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3"><label>Alamat</label><textarea name="alamat" class="form-control" rows="3"></textarea></div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection