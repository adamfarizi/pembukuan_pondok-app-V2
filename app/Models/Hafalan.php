<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hafalan extends Model
{
    use HasFactory;
    protected $table = 'hafalans';
    protected $primaryKey = 'id_hafalan';
    protected $fillable = [
        'id_santri',
        'surah',
        'total_ayat',
        'progres_ayat',
        'status',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri', 'id_santri');
    }
}
