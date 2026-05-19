<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\SiswaMapel;
use App\Models\Nilai;
use App\Models\AkunPengguna;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'kelas' => Kelas::count(),
            'guru' => Guru::count(),
            'mapel' => MataPelajaran::count(),
            'siswa' => Siswa::count(),
            'pendaftaran' => SiswaMapel::count(),
            'nilai' => Nilai::count(),
            'akun' => AkunPengguna::count(),
        ];
        
        // Data untuk chart sederhana
        $kelasData = Kelas::all();
        
        return view('dashboard', compact('stats', 'kelasData'));
    }
}