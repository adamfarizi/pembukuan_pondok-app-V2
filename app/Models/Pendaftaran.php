<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = 'pendaftarans';
    protected $primaryKey = 'id_pendaftar';
    protected $fillable = [
        'kode_pendaftaran',
        'nama_pendaftar',
        'tempat_tanggal_lahir_pendaftar',
        'jenis_kelamin_pendaftar',
        'alamat_pendaftar',
        'no_hp_pendaftar',
        'email_pendaftar',
        'ktp_pendaftar',
        'kk_pendaftar',
        'akta_pendaftar',
        'pas_foto_pendaftar',
        'nama_wali_pendaftar',
        'no_hp_wali_pendaftar',
        'email_wali_pendaftar',
        'alamat_wali_santri',
        'status',
    ];
    
}
