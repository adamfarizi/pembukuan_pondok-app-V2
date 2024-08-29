<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterGuestFoto extends Model
{
    protected $fillable = [
        'id_guest',
        'foto',
    ];


    protected $table = 'master_guests_foto';

    public function guest()
    {
        return $this->belongsTo(MasterGuest::class, 'id_guest');
    }
}
