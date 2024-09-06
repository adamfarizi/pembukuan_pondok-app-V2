<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterGuestRekening extends Model
{
    protected $primaryKey = 'id_rekening';

    protected $fillable = [
        'id_guest',
        'rekening',
    ];

    protected $table = 'master_guests_rekening';

    public function guest()
    {
        return $this->belongsTo(MasterGuest::class, 'id_guest');
    }
}
