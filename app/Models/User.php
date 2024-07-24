<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama_admin',
        'email',
        'password', 
        'remember_token',
        'role',  
        'no_hp_admin',
    ];

    protected $hidden = [
        'password',
    ];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_admin', 'id_admin');
    }

    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class, 'id_admin', 'id_admin');
    }
}
