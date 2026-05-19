<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nis', 'nama_siswa', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'id_kelas'];
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
    
    // Belongs to Kelas (One-to-Many kebalikan)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    
    // Many-to-Many ke Mata Pelajaran via siswa_mapel
    public function mataPelajarans()
    {
        return $this->belongsToMany(MataPelajaran::class, 'siswa_mapel', 'id_siswa', 'id_mapel')
                    ->withPivot('id', 'tahun_ajaran', 'semester')
                    ->withTimestamps();
    }
    
    // One-to-One ke AkunPengguna (FOREIGN KEY ada di tabel akun_pengguna)
    public function akun()
    {
        return $this->hasOne(AkunPengguna::class, 'id_siswa', 'id');
    }
    
    // One-to-Many ke SiswaMapel
    public function siswaMapels()
    {
        return $this->hasMany(SiswaMapel::class, 'id_siswa');
    }
}