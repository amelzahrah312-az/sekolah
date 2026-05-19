<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['nip', 'nama_guru', 'pendidikan_terakhir', 'no_telepon'];
    
    // One-to-Many ke Mata Pelajaran
    public function mataPelajarans()
    {
        return $this->hasMany(MataPelajaran::class, 'id_guru');
    }
}