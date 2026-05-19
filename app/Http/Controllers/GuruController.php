<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::orderBy('nama_guru')->get();
        return view('guru.index', compact('guru'));
    }
    
    public function create()
    {
        return view('guru.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:guru|max:20',
            'nama_guru' => 'required|max:100',
            'pendidikan_terakhir' => 'nullable|max:50',
            'no_telepon' => 'nullable|max:15',
        ]);
        
        Guru::create($request->all());
        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan!');
    }
    
    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }
    
    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nip' => 'required|max:20|unique:guru,nip,' . $guru->id,
            'nama_guru' => 'required|max:100',
            'pendidikan_terakhir' => 'nullable|max:50',
            'no_telepon' => 'nullable|max:15',
        ]);
        
        $guru->update($request->all());
        return redirect()->route('guru.index')->with('success', 'Guru berhasil diupdate!');
    }
    
    public function destroy(Guru $guru)
    {
        if ($guru->mataPelajarans()->count() > 0) {
            return redirect()->route('guru.index')->with('error', 'Guru tidak bisa dihapus karena masih mengajar mata pelajaran!');
        }
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus!');
    }
}