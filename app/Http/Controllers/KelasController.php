<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();
        return view('kelas.index', compact('kelas'));
    }
    
    public function create()
    {
        return view('kelas.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'nullable|string|max:50',
        ]);
        
        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }
    
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }
    
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'nullable|string|max:50',
        ]);
        
        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());
        
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }
}