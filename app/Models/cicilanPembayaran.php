<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cicilanPembayaran extends Model
{
    use HasFactory;
    
    protected $table = 'cicilan_pembayarans';
    protected $primaryKey = 'id_cicilan_pembayarans';
    protected $fillable = [
        'sub_bayar_cicilan',
        'tanggal_bayar',
        'id_pembayaran',
        'id_admin'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_admin', 'id_admin');
    }
}
