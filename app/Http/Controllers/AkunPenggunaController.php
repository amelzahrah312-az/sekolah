<?php

namespace App\Http\Controllers;

use App\Models\AkunPengguna;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AkunPenggunaController extends Controller
{
    /**
     * Menampilkan daftar semua akun pengguna
     */
    public function index()
    {
        $akun = AkunPengguna::with('siswa.kelas')->orderBy('username')->get();
        return view('akun_pengguna.index', compact('akun'));
    }
    
    /**
     * Menampilkan form untuk membuat akun baru
     */
    public function create()
    {
        // Hanya siswa yang BELUM punya akun
        $siswa = Siswa::doesntHave('akun')->with('kelas')->orderBy('nama_siswa')->get();
        return view('akun_pengguna.create', compact('siswa'));
    }
    
    /**
     * Menyimpan akun baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id|unique:akun_pengguna,id_siswa',
            'username' => 'required|min:3|max:50|unique:akun_pengguna,username',
            'password' => 'required|min:4',
            'role' => 'required|in:siswa,guru,admin',
            'status' => 'required|in:aktif,nonaktif',
        ]);
        
        AkunPengguna::create($request->all());
        
        return redirect()->route('akun-pengguna.index')
            ->with('success', 'Akun berhasil dibuat!');
    }
    
    /**
     * Menampilkan form untuk mengedit akun
     */
    public function edit(AkunPengguna $akun_pengguna)
    {
        return view('akun_pengguna.edit', compact('akun_pengguna'));
    }
    
    /**
     * Mengupdate data akun (termasuk username)
     */
    public function update(Request $request, AkunPengguna $akun_pengguna)
    {
        $request->validate([
            'username' => 'required|min:3|max:50|unique:akun_pengguna,username,' . $akun_pengguna->id,
            'role' => 'required|in:siswa,guru,admin',
            'status' => 'required|in:aktif,nonaktif',
        ]);
        
        // Data yang akan diupdate
        $data = [
            'username' => $request->username,
            'role' => $request->role,
            'status' => $request->status,
        ];
        
        // Jika password diisi, update juga password
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:4']);
            $data['password'] = $request->password;
        }
        
        $akun_pengguna->update($data);
        
        return redirect()->route('akun-pengguna.index')
            ->with('success', 'Akun berhasil diupdate!');
    }
    
    /**
     * Menghapus akun dari database
     */
    public function destroy(AkunPengguna $akun_pengguna)
    {
        $akun_pengguna->delete();
        
        return redirect()->route('akun-pengguna.index')
            ->with('success', 'Akun berhasil dihapus!');
    }
}