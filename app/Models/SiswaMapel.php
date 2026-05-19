<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaMapel extends Model
{
    protected $table = 'siswa_mapel';
    protected $fillable = ['id_siswa', 'id_mapel', 'tahun_ajaran', 'semester'];
    
    // Belongs to Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    
    // Belongs to Mata Pelajaran
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel');
    }
    
    // One-to-One ke Nilai (foreign key di tabel nilai adalah id_siswa_mapel)
    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'id_siswa_mapel', 'id');
    }
}