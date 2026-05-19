<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AkunPengguna extends Model
{
    protected $table = 'akun_pengguna';
    protected $fillable = ['username', 'password', 'role', 'status', 'terakhir_login', 'id_siswa'];
    protected $hidden = ['password'];
    
    // One-to-One kebalikan ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    
    // Auto-hash password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}