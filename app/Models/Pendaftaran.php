<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = 'pendaftarans';
    protected $primaryKey = 'id_pendaftar';
    protected $fillable = [
        'kode_pendaftaran',
        'nama_pendaftar',
        'no_identitas',
        'status_pendaftar',
        'tempat_lahir_pendaftar',
        'tanggal_lahir_pendaftar',
        'jenis_kelamin_pendaftar',
        'rt',
        'rw',
        'dusun',
        'desa',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'kode_pos',
        'no_hp_pendaftar',
        'email_pendaftar',
        'mulai_masuk_tanggal',
        'tingkatan_pendaftar',
        'jumlah_saudara_kandung',
        'anak_ke',

         //Identitas Ayah
        'nama_ayah_pendaftar',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'pendapatan_ayah_perbulan',

         //Identitas Ibu
        'nama_ibu_pendaftar',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'pendapatan_ibu_perbulan',

        //Identitas Wali
        'nama_wali_pendaftar',
        'no_identitas_wali',
        'tempat_lahir_wali',
        'tanggal_lahir_wali',
        'rt_wali',
        'rw_wali',
        'dusun_wali',
        'desa_wali',
        'kecamatan_wali',
        'kab_kota_wali',
        'provinsi_wali',
        'kode_pos_wali',
        'status_wali',
        'pekerjaan_wali',
        'pendidikan_wali',
        'pendapatan_wali_perbulan',
        'no_hp_wali_pendaftar',
        'email_wali_pendaftar',

        //Berkas-berkas
        'ktp_pendaftar',
        'kk_pendaftar',
        'akta_pendaftar',
        'pas_foto_pendaftar',
        'status',
    ];

    public function getTempatTanggalLahirPendaftarAttribute()
    {
        $formattedDate = Carbon::parse($this->tanggal_lahir_pendaftar)->format('d-M-Y');
        return "{$this->tempat_lahir_pendaftar}, {$formattedDate}";
        
    }

    public function getTempatTanggalLahirWaliPendaftarAttribute()
    {
        $formattedDate = Carbon::parse($this->tanggal_lahir_wali)->format('d-M-Y');
        return "{$this->tempat_lahir_wali}, {$formattedDate}";
        
    }
    
}
