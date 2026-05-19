<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'tingkat', 'jurusan'];
    
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }
    
    public function getJurusanSmkAttribute()
    {
    $jurusanMap = [
        'RPL' => 'Rekayasa Perangkat Lunak',
        'TKJ' => 'Teknik Komputer & Jaringan',
        'MM' => 'Multimedia',
        'AKL' => 'Akuntansi & Keuangan Lembaga',
        'OTKP' => 'Otomatisasi & Tata Kelola Perkantoran',
        'BDP' => 'Bisnis Daring & Pemasaran',
        ];
    
        return $jurusanMap[$this->jurusan] ?? $this->jurusan;
    }
}