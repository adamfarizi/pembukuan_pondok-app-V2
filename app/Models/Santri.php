<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Hafalan;
use App\Models\Pembayaran;
use App\Models\WaliSantri;
use App\Models\NilaiSantri;
use App\Models\PointSantri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Santri extends Model
{
    use HasFactory; 
    protected $table = 'santris';
    protected $primaryKey = 'id_santri';
    protected $fillable = [
        //Santri
        'nama_santri',
        'no_induk',
        'status_santri',
        'no_identitas',
        'tempat_lahir_santri',
        'tanggal_lahir_santri',
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
        'tingkatan',
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

    public function getTempatTanggalLahirSantriAttribute()
    {
        $formattedDate = Carbon::parse($this->tanggal_lahir_santri)->format('d-M-Y');
        return "{$this->tempat_lahir_santri}, {$formattedDate}";
        
    }

    public function getAlamatSantriAttribute()
    {
        return "RT.{$this->rt}/RW.{$this->rw}, {$this->dusun}, {$this->desa}, {$this->kecamatan}, {$this->kab_kota}, {$this->provinsi}, {$this->kode_pos}";
    }

}
