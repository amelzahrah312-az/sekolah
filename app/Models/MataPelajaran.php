<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';
    protected $fillable = ['kode_mapel', 'nama_mapel', 'id_guru'];
    
    // Belongs to Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
    
    // Many-to-Many ke Siswa
    public function siswas()
    {
        return $this->belongsToMany(MataPelajaran::class, 'siswa_mapel', 'id_mapel', 'id_siswa')
                    ->withPivot('tahun_ajaran', 'semester')
                    ->withTimestamps();
    }
    
    // One-to-Many ke SiswaMapel
    public function siswaMapels()
    {
        return $this->hasMany(MataPelajaran::class, 'id_mapel');
    }
}