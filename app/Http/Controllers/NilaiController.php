<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\SiswaMapel;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::with(['siswaMapel.siswa.kelas', 'siswaMapel.mataPelajaran'])->get();
        return view('nilai.index', compact('nilai'));
    }
    
    public function create()
    {
        $siswaMapel = SiswaMapel::with(['siswa', 'mataPelajaran'])
            ->whereDoesntHave('nilai') // Hanya yang belum punya nilai
            ->get();
        return view('nilai.create', compact('siswaMapel'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_siswa_mapel' => 'required|exists:siswa_mapel,id|unique:nilai,id_siswa_mapel',
            'nilai_uh1' => 'nullable|numeric|min:0|max:100',
            'nilai_uh2' => 'nullable|numeric|min:0|max:100',
            'nilai_uts' => 'nullable|numeric|min:0|max:100',
            'nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);
        
        Nilai::create($request->all());
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan!');
    }
    
    public function edit(Nilai $nilai)
    {
        return view('nilai.edit', compact('nilai'));
    }
    
    public function update(Request $request, Nilai $nilai)
    {
        $request->validate([
            'nilai_uh1' => 'nullable|numeric|min:0|max:100',
            'nilai_uh2' => 'nullable|numeric|min:0|max:100',
            'nilai_uts' => 'nullable|numeric|min:0|max:100',
            'nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);
        
        $nilai->update($request->all());
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diupdate!');
    }
    
    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus!');
    }
}