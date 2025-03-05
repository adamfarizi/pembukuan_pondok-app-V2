<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAdminRincian extends Model
{
    use HasFactory;
    protected $table = 'master_admin_rincian';
    protected $primaryKey = 'id_master_admin_rincian';
    protected $fillable = [
        'jenis_mukim',
        'jenis_pembayaran',
        'jenis_santri',
        'keterangan_pembayaran',
        'jumlah_pembayaran',
    ];
}
