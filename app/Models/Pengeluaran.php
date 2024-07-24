<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    
    protected $table = 'pengeluarans';
    protected $primaryKey = 'id_pengeluaran';
    protected $fillable = [
        'jumlah_pengeluaran',
        'tanggal_pengeluaran',
        'deskripsi_pengeluaran',
        'nama_pengeluar',
        'id_admin',
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id_admin');
    }
   
}
