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
        'nama_wali_santri', 
        'email', 
        'password',
        'remember_token', // Jika Anda ingin menggunakan remember_token
        'role', 
        'no_hp', 
        'alamat_wali_santri', 
        'id_santri',
    ];

    protected $hidden = [
        'password',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }
}
