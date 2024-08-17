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
        //Santri
        'nama_santri',
        'no_identitas',
        'tempat_tanggal_lahir_santri',
        'jenis_kelamin_santri',
        'rt',
        'rw',
        'dusun',
        'desa',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'kode_pos',
        'no_hp_santri',
        'email_santri',
        'tahun_masuk',
        'jumlah_saudara_kandung',
        'anak_ke',

        //Identitas Ayah
        'nama_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'pendapatan_ayah_perbulan',

        //Identitas Ibu
        'nama_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'pendapatan_ibu_perbulan',

        //Berkas-berkas
        'ktp_santri',
        'kk_santri',
        'akta_santri',
        'pas_foto_santri',
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

    public function getAlamatSantriAttribute()
    {
        return "RT.{$this->rt}/RW.{$this->rw}, {$this->dusun}, {$this->desa}, {$this->kecamatan}, {$this->kab_kota}, {$this->provinsi}, {$this->kode_pos}";
    }

}
