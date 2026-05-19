@extends('layouts.app')

@section('title', 'Input Nilai')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white"><h5 class="mb-0">Form Input Nilai</h5></div>
    <div class="card-body">
        <form method="POST" action="{{ route('nilai.store') }}">
            @csrf
            <div class="mb-3">
                <label>Pilih Siswa & Mapel</label>
                <select name="id_siswa_mapel" class="form-control" required>
                    <option value="">- Pilih -</option>
                    @foreach($siswaMapel as $sm)
                    <option value="{{ $sm->id }}">{{ $sm->siswa->nama_siswa }} ({{ $sm->siswa->nis }}) - {{ $sm->mataPelajaran->nama_mapel }} ({{ $sm->tahun_ajaran }} {{ $sm->semester }})</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-3"><label>Nilai UH1</label><input type="number" step="0.01" name="nilai_uh1" class="form-control" placeholder="0-100"></div>
                <div class="col-md-3"><label>Nilai UH2</label><input type="number" step="0.01" name="nilai_uh2" class="form-control" placeholder="0-100"></div>
                <div class="col-md-3"><label>Nilai UTS</label><input type="number" step="0.01" name="nilai_uts" class="form-control" placeholder="0-100"></div>
                <div class="col-md-3"><label>Nilai UAS</label><input type="number" step="0.01" name="nilai_uas" class="form-control" placeholder="0-100"></div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan Nilai</button>
            <a href="{{ route('nilai.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>
@endsection