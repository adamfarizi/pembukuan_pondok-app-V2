<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = [
        'tanggal_pembayaran',
        'jumlah_pembayaran',
        'jenis_pembayaran',
        'semester_ajaran',
        'tahun_ajaran',
        'status_pembayaran',
        'id_santri',
        'id_admin',
    ];

    public function santri()
    {
        return $this->hasOne(Santri::class, 'id_santri', 'id_santri');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_admin', 'id_admin');
    }
}
