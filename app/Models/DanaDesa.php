<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanaDesa extends Model
{
    protected $fillable = [
        'nama_program',
        'kategori',
        'anggaran',
        'progress',
        'status',
        'target'
    ];
}