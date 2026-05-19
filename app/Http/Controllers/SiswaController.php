<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil semua siswa dengan relasi yang diperlukan
        $siswa = Siswa::with(['kelas', 'akun'])->get();
        return view('siswa.index', compact('siswa'));
    }
    
    public function create()
    {
        $kelas = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();
        return view('siswa.create', compact('kelas'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa|max:20',
            'nama_siswa' => 'required|max:100',
            'tempat_lahir' => 'nullable|max:50',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'id_kelas' => 'nullable|exists:kelas,id',
        ]);
        
        Siswa::create($request->all());
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }
    
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }
    
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|max:20|unique:siswa,nis,' . $siswa->id,
            'nama_siswa' => 'required|max:100',
            'tempat_lahir' => 'nullable|max:50',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'id_kelas' => 'nullable|exists:kelas,id',
        ]);
        
        $siswa->update($request->all());
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diupdate!');
    }
    
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus!');
    }
    
    public function show(Siswa $siswa)
    {
        $siswa->load(['kelas', 'mataPelajarans.guru', 'akun', 'siswaMapels.nilai']);
        return view('siswa.show', compact('siswa'));
    }
}