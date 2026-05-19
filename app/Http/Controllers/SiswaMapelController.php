<?php

namespace App\Http\Controllers;

use App\Models\SiswaMapel;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class SiswaMapelController extends Controller
{
    public function index()
    {
        $pendaftaran = SiswaMapel::with(['siswa.kelas', 'mataPelajaran.guru'])->get();
        return view('siswa_mapel.index', compact('pendaftaran'));
    }
    
    public function create()
    {
        $siswa = Siswa::with('kelas')->orderBy('nama_siswa')->get();
        $mapel = MataPelajaran::with('guru')->orderBy('nama_mapel')->get();
        return view('siswa_mapel.create', compact('siswa', 'mapel'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id',
            'id_mapel' => 'required|exists:mata_pelajaran,id',
            'tahun_ajaran' => 'required|max:20',
            'semester' => 'required|in:Ganjil,Genap',
        ]);
        
        // Cek duplikasi
        $exists = SiswaMapel::where('id_siswa', $request->id_siswa)
            ->where('id_mapel', $request->id_mapel)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->where('semester', $request->semester)
            ->exists();
            
        if ($exists) {
            return redirect()->back()->with('error', 'Siswa sudah terdaftar di mapel ini pada tahun/semester yang sama!')->withInput();
        }
        
        SiswaMapel::create($request->all());
        return redirect()->route('siswa-mapel.index')->with('success', 'Pendaftaran mapel berhasil!');
    }
    
    public function edit(SiswaMapel $siswa_mapel)
    {
        $siswa = Siswa::with('kelas')->orderBy('nama_siswa')->get();
        $mapel = MataPelajaran::with('guru')->orderBy('nama_mapel')->get();
        return view('siswa_mapel.edit', compact('siswa_mapel', 'siswa', 'mapel'));
    }
    
    public function update(Request $request, SiswaMapel $siswa_mapel)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id',
            'id_mapel' => 'required|exists:mata_pelajaran,id',
            'tahun_ajaran' => 'required|max:20',
            'semester' => 'required|in:Ganjil,Genap',
        ]);
        
        $siswa_mapel->update($request->all());
        return redirect()->route('siswa-mapel.index')->with('success', 'Pendaftaran mapel berhasil diupdate!');
    }
    
    public function destroy(SiswaMapel $siswa_mapel)
    {
        $siswa_mapel->delete();
        return redirect()->route('siswa-mapel.index')->with('success', 'Pendaftaran mapel berhasil dihapus!');
    }
}