<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointSantri extends Model
{
    use HasFactory;
    protected $table = 'point_santris';
    protected $primaryKey = 'id_point_santri';
    protected $fillable = [
        'tanggal_point_santri',
        'semester_ajaran',
        'tahun_ajaran',
        'jenis_point_santri',
        'jumlah_point_santri',
        'deskripsi_point_santri',
        'id_santri',
    ];

    
    public function santri()
    {
        return $this->belongsToe(Santri::class, 'id_santri');
    }


}