<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\SiswaMapel;
use App\Models\Nilai;
use App\Models\AkunPengguna;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kelas
        $kelasIPA = Kelas::create(['nama_kelas' => 'A', 'tingkat' => 'X', 'jurusan' => 'IPA']);
        $kelasIPS = Kelas::create(['nama_kelas' => 'B', 'tingkat' => 'X', 'jurusan' => 'IPS']);
        
        // Guru
        $guru1 = Guru::create(['nip' => '198001012010011001', 'nama_guru' => 'Dr. Budi Santoso, M.Pd', 'pendidikan_terakhir' => 'S3', 'no_telepon' => '081234567890']);
        $guru2 = Guru::create(['nip' => '198502152012012002', 'nama_guru' => 'Siti Aminah, S.Pd', 'pendidikan_terakhir' => 'S1', 'no_telepon' => '081234567891']);
        
        // Mata Pelajaran
        $matematika = MataPelajaran::create(['kode_mapel' => 'MTK01', 'nama_mapel' => 'Matematika', 'id_guru' => $guru1->id]);
        $inggris = MataPelajaran::create(['kode_mapel' => 'BIG01', 'nama_mapel' => 'Bahasa Inggris', 'id_guru' => $guru2->id]);
        
        // Siswa
        $siswa1 = Siswa::create(['nis' => '12345', 'nama_siswa' => 'Ahmad Wijaya', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '2008-05-15', 'alamat' => 'Jl. Merdeka No.1', 'id_kelas' => $kelasIPA->id]);
        $siswa2 = Siswa::create(['nis' => '12346', 'nama_siswa' => 'Budi Prasetyo', 'tempat_lahir' => 'Bandung', 'tanggal_lahir' => '2008-08-20', 'alamat' => 'Jl. Asia Afrika No.2', 'id_kelas' => $kelasIPS->id]);
        
        // Many-to-Many: SiswaMapel
        $sm1 = SiswaMapel::create(['id_siswa' => $siswa1->id, 'id_mapel' => $matematika->id, 'tahun_ajaran' => '2024/2025', 'semester' => 'Ganjil']);
        $sm2 = SiswaMapel::create(['id_siswa' => $siswa1->id, 'id_mapel' => $inggris->id, 'tahun_ajaran' => '2024/2025', 'semester' => 'Ganjil']);
        $sm3 = SiswaMapel::create(['id_siswa' => $siswa2->id, 'id_mapel' => $inggris->id, 'tahun_ajaran' => '2024/2025', 'semester' => 'Ganjil']);
        
        // Nilai
        Nilai::create(['id_siswa_mapel' => $sm1->id, 'nilai_uh1' => 85, 'nilai_uh2' => 90, 'nilai_uts' => 88, 'nilai_uas' => 92]);
        Nilai::create(['id_siswa_mapel' => $sm2->id, 'nilai_uh1' => 75, 'nilai_uh2' => 78, 'nilai_uts' => 80, 'nilai_uas' => 82]);
        
        // One-to-One: Akun Pengguna
        AkunPengguna::create(['username' => 'ahmad123', 'password' => 'password123', 'role' => 'siswa', 'status' => 'aktif', 'id_siswa' => $siswa1->id]);
    }
}