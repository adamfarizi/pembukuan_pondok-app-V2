<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAdmin extends Model
{
    use HasFactory;
    protected $table = 'master_admin';
    protected $primaryKey = 'id_master_admin';
    protected $fillable = [
        'jenis_pembayaran',
        'keterangan_pembayaran',
        'jumlah_pembayaran',
    ];
}
