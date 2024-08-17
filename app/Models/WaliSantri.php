<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WaliSantri extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'wali_santri'; // Nama guard yang digunakan untuk otentikasi

    protected $table = 'wali_santris';
    protected $primaryKey = 'id_wali_santri';
    protected $fillable = [ 
        'id_santri',
        'nama_wali',
        'no_identitas_wali',
        'tempat_tanggal_lahir_wali',
        'rt_wali',
        'rw_wali',
        'dusun_wali',
        'desa_wali',
        'kecamatan_wali',
        'kab_kota_wali',
        'provinsi_wali',
        'kode_pos_wali',
        'status_wali',
        'no_hp',
        'email',
        'password',
        'role',
        'pendidikan_wali',
        'pekerjaan_wali',
        'pendapatan_wali_perbulan',
    ];

    protected $hidden = [
        'password',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }

    public function getAlamatWaliAttribute()
    {
        return "RT.{$this->rt_wali}/RW.{$this->rw_wali}, {$this->dusun_wali}, {$this->desa_wali}, {$this->kecamatan_wali}, {$this->kab_kota_wali}, {$this->provinsi_wali}, {$this->kode_pos_wali}";
    }
}
