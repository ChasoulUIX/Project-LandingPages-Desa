<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kegiatan extends Model
{
    use SoftDeletes;
    
    protected $table = 'kegiatan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'image',
        'kategori',
        'anggaran',
        'sumber_dana',
        'tgl_mulai',
        'tgl_selesai',
        'progress'
    ];

    protected $casts = [
        'anggaran' => 'decimal:2',
        'progress' => 'integer',
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date'
    ];
}