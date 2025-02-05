<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    protected $fillable = [
        'nik',
        'password',
        'nama',
        'jabatan',
        'no_wa',
        'akses',
        'periode_mulai',
        'periode_akhir',
        'status',
        'image'
    ];
}