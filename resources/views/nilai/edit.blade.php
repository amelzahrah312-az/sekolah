@extends('layouts.app')

@section('title', 'Edit Nilai')

@section('content')
<div class="card">
    <div class="card-header bg-warning"><h5 class="mb-0">Edit Nilai</h5></div>
    <div class="card-body">
        <form method="POST" action="{{ route('nilai.update', $nilai) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-3"><label>UH1</label><input type="number" step="0.01" name="nilai_uh1" value="{{ $nilai->nilai_uh1 }}" class="form-control"></div>
                <div class="col-md-3"><label>UH2</label><input type="number" step="0.01" name="nilai_uh2" value="{{ $nilai->nilai_uh2 }}" class="form-control"></div>
                <div class="col-md-3"><label>UTS</label><input type="number" step="0.01" name="nilai_uts" value="{{ $nilai->nilai_uts }}" class="form-control"></div>
                <div class="col-md-3"><label>UAS</label><input type="number" step="0.01" name="nilai_uas" value="{{ $nilai->nilai_uas }}" class="form-control"></div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a href="{{ route('nilai.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>
@endsection