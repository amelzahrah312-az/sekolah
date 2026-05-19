@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-person-badge"></i> Data Guru</h2>
    <a href="{{ route('guru.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Guru
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>NIP</th>
                        <th>Nama Guru</th>
                        <th>Pendidikan</th>
                        <th>No Telepon</th>
                        <th>Mata Pelajaran</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guru as $index => $g)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $g->nip }}</strong></td>
                        <td>{{ $g->nama_guru }}</td>
                        <td>{{ $g->pendidikan_terakhir ?? '-' }}</td>
                        <td>{{ $g->no_telepon ?? '-' }}</td>
                        <td>
                            @php
                                $jumlahMapel = $g->mataPelajarans ? $g->mataPelajarans->count() : 0;
                            @endphp
                            {{ $jumlahMapel }} Mapel
                        </td>
                        <td>
                            <a href="{{ route('guru.edit', $g->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('guru.destroy', $g->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus guru {{ $g->nama_guru }}?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-1 d-block"></i>
                            Belum ada data guru
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection