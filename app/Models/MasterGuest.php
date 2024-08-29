<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterGuest extends Model
{
    
    use HasFactory;

    protected $table = 'master_guests';
    protected $primaryKey = 'id_guest';
    protected $fillable = [
        'visi',
        'lokasi',
        'linkgmaps',
        'no_tlp',
        'email',
        'instagram',
        'youtube',
        'facebook',
    ];           
    

    public function foto()
    {
        return $this->hasMany(MasterGuestFoto::class, 'id_guest', 'id_guest');
    }

    public function misi()
    {
        return $this->hasMany(MasterGuestMisi::class, 'id_guest', 'id_guest');
    }
}
