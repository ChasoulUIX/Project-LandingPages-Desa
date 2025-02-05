<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanaDesa extends Model
{
    use SoftDeletes;
    
    protected $table = 'danadesa';

    protected $fillable = [
        'tahun_anggaran',
        'sumber_anggaran', 
        'nominal',
        'tgl_pencairan',
        'status_pencairan',
        'dana_masuk',
        'dana_terpakai',
        'nama_program',
        'photos'
    ];

    protected $casts = [
        'tahun_anggaran' => 'integer',
        'nominal' => 'decimal:2',
        'status_pencairan' => 'integer',
        'dana_masuk' => 'decimal:2', 
        'dana_terpakai' => 'decimal:2',
        'tgl_pencairan' => 'date',
        'photos' => 'array'
    ];
}
