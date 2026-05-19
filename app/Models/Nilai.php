<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = ['id_siswa_mapel', 'nilai_uh1', 'nilai_uh2', 'nilai_uts', 'nilai_uas', 'nilai_akhir', 'predikat'];
    
    // Belongs to SiswaMapel
    public function siswaMapel()
    {
        return $this->belongsTo(SiswaMapel::class, 'id_siswa_mapel');
    }
    
    // Auto-hitung nilai akhir sebelum save
    protected static function booted()
    {
        static::saving(function ($nilai) {
            $arr = [];
            if ($nilai->nilai_uh1) $arr[] = $nilai->nilai_uh1;
            if ($nilai->nilai_uh2) $arr[] = $nilai->nilai_uh2;
            if ($nilai->nilai_uts) $arr[] = $nilai->nilai_uts;
            if ($nilai->nilai_uas) $arr[] = $nilai->nilai_uas;
            
            if (count($arr) > 0) {
                $rata = array_sum($arr) / count($arr);
                $nilai->nilai_akhir = round($rata, 2);
                
                if ($rata >= 85) $nilai->predikat = 'A';
                elseif ($rata >= 75) $nilai->predikat = 'B';
                elseif ($rata >= 60) $nilai->predikat = 'C';
                else $nilai->predikat = 'D';
            }
        });
    }
}