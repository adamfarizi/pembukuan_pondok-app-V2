<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterGuestMisi extends Model
{
    protected $primaryKey = 'id_misi';

    protected $fillable = [
        'id_guest',
        'misi',
    ];

    protected $table = 'master_guests_misi';

    public function guest()
    {
        return $this->belongsTo(MasterGuest::class, 'id_guest');
    }
}
