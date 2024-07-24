<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukans';
    protected $primaryKey = 'id_pemasukan';
    protected $fillable = [
        'nama_pengirim',
        'jumlah_pemasukan',
        'tanggal_pemasukan',
        'deskripsi_pemasukan',
        'bukti_pemasukan',
        'id_admin',
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id_admin', 'id_admin');
    }
}
