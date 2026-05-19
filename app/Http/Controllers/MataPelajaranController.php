<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::with(['guru', 'siswas'])->orderBy('nama_mapel')->get();
        return view('mata_pelajaran.index', compact('mapel'));
    }
    
    public function create()
    {
        $guru = Guru::orderBy('nama_guru')->get();
        return view('mata_pelajaran.create', compact('guru'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kode_mapel' => 'required|unique:mata_pelajaran|max:10',
            'nama_mapel' => 'required|max:100',
            'id_guru' => 'nullable|exists:guru,id',
        ]);
        
        MataPelajaran::create($request->all());
        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil ditambahkan!');
    }
    
    public function edit($id)
    {
        $mata_pelajaran = MataPelajaran::findOrFail($id);
        $guru = Guru::orderBy('nama_guru')->get();
        return view('mata_pelajaran.edit', compact('mata_pelajaran', 'guru'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_mapel' => 'required|max:10|unique:mata_pelajaran,kode_mapel,' . $id,
            'nama_mapel' => 'required|max:100',
            'id_guru' => 'nullable|exists:guru,id',
        ]);
        
        $mata_pelajaran = MataPelajaran::findOrFail($id);
        $mata_pelajaran->update($request->all());
        
        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $mata_pelajaran = MataPelajaran::findOrFail($id);
        $mata_pelajaran->delete();
        
        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil dihapus!');
    }
}