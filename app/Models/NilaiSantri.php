<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSantri extends Model
{
    use HasFactory;

    protected $table = 'nilai_santris';
    protected $primaryKey = 'id_nilai';
    protected $fillable = [
        'id_santri',
        'semester_ajaran',
        'tahun_ajaran',
        'mata_peajaran',
        'nilai',
    ];


    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri','id_santri');
    }
}
