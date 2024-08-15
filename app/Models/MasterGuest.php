<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGuest extends Model
{
    use HasFactory;

    protected $table = 'master_guests';

    protected $fillable = [
        'visi', 'misi', 'foto', 'lokasi', 'no_tlp', 'email', 'instagram', 'youtube', 'facebook',
    ];
}
