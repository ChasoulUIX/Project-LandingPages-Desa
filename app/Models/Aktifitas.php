<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aktifitas extends Model
{
    protected $table = 'aktifitas';
    
    protected $fillable = [
        'judul',
        'deskripsi', 
        'image',
        'tgl_mulai'
    ];

    protected $casts = [
        'tgl_mulai' => 'date'
    ];
}
