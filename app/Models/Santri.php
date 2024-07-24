<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory; 
    protected $table = 'santris';
    protected $primaryKey = 'id_santri';
    protected $fillable = [
        'nama_santri', 
        'tempat_tanggal_lahir_santri', 
        'jenis_kelamin_santri', 
        'alamat_santri', 
        'no_hp_santri', 
        'email_santri', 
        'ktp_santri', 
        'kk_santri',
        'akta_santri',
        'pas_foto_santri', 
        'status_santri', 
        'tahun_masuk', 
    ];


    public function WaliSantri()
    {
        return $this->hasOne(WaliSantri::class, 'id_santri', 'id_santri');
    }
    
    public function Pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_santri', 'id_santri');
    }
    
    public function NilaiSantri()
    {
        return $this->hasMany(NilaiSantri::class, 'id_santri', 'id_santri');
    }

    public function PointSantri()
    {
        return $this->hasMany(PointSantri::class, 'id_santri', 'id_santri');
    }

    public function Hafalan()
    {
        return $this->hasMany(Hafalan::class, 'id_santri', 'id_santri');
    }


}
